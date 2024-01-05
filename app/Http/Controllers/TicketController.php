<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Baggage;
use App\Models\Flight;
use App\Models\FlightClass;
use App\Models\Purchase;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    use HttpResponses;

    public function store(Request $request)
    {
        // Validação dos dados da requisição
        $request->validate([
            'buyer_name' => 'required|string',
            'buyer_cpf' => 'required|string',
            'buyer_birthday' => 'required|date',
            'quantity_tickets' => 'required|numeric',
            'flight_id' => 'required|exists:flights,id',
            'tickets' => 'required|array|min:1',
            'tickets.*.passenger_name' => 'required|string|distinct',
            'tickets.*.passenger_cpf' => 'required|string|distinct',
            'tickets.*.passenger_birthday' => 'required|date',
            'tickets.*.has_baggage' => 'boolean',
            'tickets.*.has_dispatch' => 'boolean',
            'tickets.*.flight_class_id' => 'required|exists:flight_classes,id',
        ]);

        $ticketsComplete = DB::transaction(function () use ($request) {
            // Lógica de analise de voo
            $flight = Flight::findOrFail($request->input('flight_id'));
            if($flight->departure_datetime < Carbon::now()) {
                return $this->error('Voo não encontrado.');
            }

            $purchase = Purchase::create([
                'buyer_name' => $request->input('buyer_name'),
                'buyer_cpf' => $request->input('buyer_cpf'),
                'buyer_birthday' => $request->input('buyer_birthday'),
                'buyer_email' => $request->input('buyer_email'),
                'quantity_tickets' => $request->input('quantity_tickets')
            ]);
            
            // Criar a passagem
            foreach($request->input('tickets') as $tickets) {

                // Verifica se existe assento disponivel
                $seat = Ticket::where('flight_class_id', $tickets['flight_class_id'])->count();
                
                // Lógica para compra de passagem
                $flightClass = FlightClass::findOrFail($tickets['flight_class_id']);

                if($seat === $flightClass->seat_quantity){
                    return $ticketsComplete[] = ['error' => 'Não existe mais assentos para este voo.'];
                }

                $totalPrice = $flightClass->seat_price;

                if ($tickets['has_baggage']) {
                    
                    if($tickets['has_dispatch']) {
                        $totalPrice *= 1.1;
                    }
                    
                    $ticket = Ticket::create([
                        'flight_class_id' => $tickets['flight_class_id'],
                        'flight_id' => $request->input('flight_id'),
                        'passenger_name' => $tickets['passenger_name'],
                        'passenger_cpf' => $tickets['passenger_cpf'],
                        'passenger_birthday' => $tickets['passenger_birthday'],
                        'total_price' => $totalPrice,
                        'number' => uniqid('#'),
                        'purchase_id' => $purchase->id,
                    ]);
    
                    // Lógica para despacho de bagagem
                    Baggage::create([
                        'number' => uniqid('#'), // Gere um número de identificação único para a bagagem
                        'ticket_id' => $ticket->id,
                    ]);
                }else {
                    $ticket = Ticket::create([
                        'flight_class_id' => $tickets['flight_class_id'],
                        'flight_id' => $request->input('flight_id'),
                        'passenger_name' => $tickets['passenger_name'],
                        'passenger_cpf' => $tickets['passenger_cpf'],
                        'passenger_birthday' => $tickets['passenger_birthday'],
                        'total_price' => $totalPrice,
                        'number' => uniqid('#'),
                        'purchase_id' => $purchase->id,
                    ]);
                }
            }
            

            return $ticket->with('baggages')->get();
        });

        if (is_array($ticketsComplete) && isset($ticketsComplete['error'])) {
            // Um erro ocorreu durante a transação
            return $this->error($ticketsComplete['error'], 404);
        }

        return $this->response('O Voo foi criado com sucesso', $ticketsComplete);
    }

    // Método para emitir voucher da passagem
    public function emmitVoucher(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
        ]);
    
        $ticket = Ticket::findOrFail($request->input('ticket_id'));
        $flight = Flight::findOrFail($ticket->flight_id);
    
        // Verifica se é possível emitir o voucher (no máximo 5 horas antes do voo)
        $timeDifference = Carbon::parse($flight->departure_datetime)->diffInHours(Carbon::now());
        $maxTimeDifference = 5 * 60 * 60; // 5 horas em segundos
    
        if ($timeDifference < 0 || $timeDifference > $maxTimeDifference) {
            return $this->error('Não é possível emitir o voucher neste momento.', 422);
        }
    
        // Criação do voucher
        $voucherData = [
            'ticket_number' => $ticket->number,
            'flight_number' => $flight->id,
            'origin' => $flight->origin->name,
            'destination' => $flight->destination->name,
            'passenger' => $ticket->passenger_name,
            'has_baggage' => !is_null($ticket->baggages()->first()),
        ];
    
        return $this->response('Voucher emitido com sucesso.', $voucherData);
    }

    // Método para emitir etiqueta de bagagem
    public function emmitBaggage(Request $request)
    {
        $request->validate([
            'ticket_number' => 'required|exists:tickets,number',
            'baggage_number' => 'required|exists:baggages,number',
            'passenger_name' => 'required|exists:tickets,passenger_name',
        ]);

        $tickets = Ticket::where(['number' => $request->input('ticket_number'), 'passenger_name' => $request->input('passenger_name')])->first();

        $baggageData = [
            'tag' => uniqid("#"),
            'ticket_number' => $tickets->number
        ];

        return $this->response('Etiqueta de bagagem emitada com sucesso.', $baggageData);
    }
}
