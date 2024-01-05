<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\FlightClass;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('index','store','update');
    }

    public function index()
    {
        $flights =  Flight::with('origin', 'destination', 'airplane', 'airplane.flightClasses')->get();

        if(!$flights){
            return $this->error('Não existe voos no momento.', 404, true);
        }
        return $this->response('Os voos foram listado com sucesso.',[
            'flights' => $flights
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id|different:origin_airport_id',
            'departure_datetime' => 'required|date_format:Y-m-d H:i',
            'arrival_datetime' => 'required|date_format:Y-m-d H:i|after:departure_datetime',
            'classes' => 'required|array|min:1', // É necessário pelo menos uma classe
            'classes.*.class_name' => 'required|string|distinct',
            'classes.*.seat_quantity' => 'required|integer|min:10', // É necessário pelo menos dez assentos
            'classes.*.seat_price' => 'required|numeric|min:0', // Não é permitido numeros negativos
            'airplane_id' => 'required|exists:airplanes,id',
        ]);


        // Verifica o intervalo do voo
        $latestFlight = Flight::where('airplane_id', $request->input('airplane_id'))->latest()->first();

        // Verifica se o voo está definido e se a data de chegada é maior ou igual à ultima data de partida
        if(isset($latestFlight) && (Carbon::parse($latestFlight->arrival_datetime) >= Carbon::parse($request->input('departure_datetime')))){
            return $this->error('Já existe reserva para este voo no intervalo definido.');
        }  

        $flightComplete = DB::transaction(function () use ($request) {
            // Criação do Voo
            $flight = Flight::create([
                'origin_airport_id' => $request->input('origin_airport_id'),
                'destination_airport_id' => $request->input('destination_airport_id'),
                'departure_datetime' => $request->input('departure_datetime'),
                'arrival_datetime' =>  $request->input('arrival_datetime'),
                'airplane_id' => $request->input('airplane_id'),
            ]);

            // Criação das classes do voo
            foreach ($request->input('classes') as $class) {
                FlightClass::create([
                    'name' => $class['class_name'],
                    'seat_quantity' => $class['seat_quantity'],
                    'seat_price' => $class['seat_price'],
                    'airplane_id' => $request->input('airplane_id'),
                ]);
            }
            
            return $flight->with('origin', 'destination', 'airplane', 'airplane.flightClasses')->find($flight->id);
        });

        // Verificar o resultado da transação
        if (is_array($flightComplete) && isset($flightComplete['error'])) {
            // Um erro ocorreu durante a transação
            return $this->error($flightComplete, 500);
        }

        return $this->response('O Voo foi criado com sucesso', $flightComplete);
    }

    public function show(Request $request)
    {
        $flights = DB::transaction(function () use ($request) {
            $flight = Flight::whereHas('origin', function ($query) use ($request) {
                    $query->where('name', $request->input('origin_airport'));
                })
                ->whereHas('destination', function ($query) use ($request) {
                    $query->where('name', $request->input('destination_airport'));
                })
                ->whereDate('departure_datetime', '=',$request->input('departure_date'))
                ->where('departure_datetime', '>', now()->addHours(6))
                ->when($request->has('price'), function ($query) use ($request) {
                    $query->whereHas('airplane.flightClasses', function ($subquery) use ($request) {
                        $subquery->where('seat_price', '<=', $request->input('price'));
                    });
                })
                ->with(['origin', 'destination', 'airplane', 'airplane.flightClasses' => function ($query) use ($request) {
                    $query->when($request->has('price'), function ($subquery) use ($request) {
                        $subquery->where('seat_price', '<=', $request->input('price'));
                    });
                }])
                ->get();

            return $flight;
        });

        if (is_array($flights) && isset($flights['error'])) {
            return $this->error($flights, 500);
        }
        
        return $this->response('Passagens atualizadas.', $flights);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'origin_airport_id' => 'exists:airports,id',
            'destination_airport_id' => 'exists:airports,id|different:origin_airport_id',
            'departure_datetime' => 'date_format:Y-m-d H:i',
            'arrival_datetime' => 'date_format:Y-m-d H:i|after:departure_datetime',
            'classes' => 'array|min:1',
            'classes.*.class_name' => 'string|distinct',
            'classes.*.seat_quantity' => 'integer|min:10',
            'classes.*.seat_price' => 'numeric|min:0',
            'airplane_id' => 'exists:airplanes,id',
        ]);

        
        $flightComplete = DB::transaction(function () use ($request, $id) {
            // Busca o voo pelo ID
            $flightConsult = Flight::findOrFail($id);

            // Atualiza apenas os campos presentes na requisição
            $flightConsult->update($request->only([
                'origin_airport_id',
                'destination_airport_id',
                'departure_datetime',
                'arrival_datetime',
            ]));

            // Atualiza as classes relacionadas caso existam
            if ($request->has('classes') && is_array($request->classes)) {
                foreach ($request->classes as $classData) {
                    // Encontrar a classe pelo ID caso exista ou criar uma nova
                    $flightClass = FlightClass::findOrNew($classData['id'] ?? null);

                    // Atualizar os campos da classe
                    $flightClass->update([
                        'class_name' => $classData['class_name'],
                        'seat_quantity' => $classData['seat_quantity'],
                        'seat_price' => $classData['seat_price'],
                    ]);
                }
            }

            return $flightConsult->with('origin', 'destination', 'airplane', 'airplane.flightClasses')->find($flightConsult->id);
        });
        
        if (is_array($flightComplete) && isset($flightComplete['error'])) {
            return $this->error($flightComplete, 500);
        }

        return $this->response('O Voo foi atualizado com sucesso', $flightComplete);
    }

    public function cancelFlight($id)
    {
        $flight = Flight::findOrFail($id);

        if(!$flight) {
            return $this->error('Esse voo não existe.', 404, true);
        }

        $flight->delete();

        return $this->response('O Voo foi cancelado com sucesso.');
    }
}
