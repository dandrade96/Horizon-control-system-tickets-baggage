<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            [
                "name" => "Aeroporto Internacional de Rio Branco – Plácido de Castro",
                "iata" => "RBR",
                "city" => "Rio Branco",
                "abbreviation" => "AC"
            ],
            [
                "name" => "Aeroporto Internacional Zumbi dos Palmares",
                "iata" => "MCZ",
                "city" => "Maceió",
                "abbreviation" => "AL"
            ],
            [
                "name" => "Aeroporto Internacional de Macapá - Alberto Alcolumbre",
                "iata" => "MCP",
                "city" => "Macapá",
                "abbreviation" => "AP"
            ],
            [
                "name" => "Aeroporto Internacional Eduardo Gomes",
                "iata" => "MAO",
                "city" => "Manaus",
                "abbreviation" => "AM"
            ],
            [
                "name" => "Aeroporto Internacional de Salvador-Deputado Luís Eduardo Magalhães",
                "iata" => "SSA",
                "city" => "Salvador",
                "abbreviation" => "BA"
            ],
            [
                "name" => "Aeroporto Internacional de Porto Seguro",
                "iata" => "BPS",
                "city" => "Porto Seguro",
                "abbreviation" => "BA"
            ],
            [
                "name" => "Aeroporto Internacional Pinto Martins",
                "iata" => "FOR",
                "city" => "Fortaleza",
                "abbreviation" => "CE"
            ],
            [
                "name" => "Aeroporto Internacional de Brasília - Presidente Juscelino Kubitschek",
                "iata" => "BSB",
                "city" => "Brasília",
                "abbreviation" => "DF"
            ],
            [
                "name" => "Aeroporto de Vitória - Eurico de Aguiar Salles",
                "iata" => "VIX",
                "city" => "Vitória",
                "abbreviation" => "ES"
            ],
            [
                "name" => "Aeroporto Santa Genoveva",
                "iata" => "GYN",
                "city" => "Goiânia",
                "abbreviation" => "GO"
            ],
            [
                "name" => "Aeroporto Internacional Marechal Cunha Machado",
                "iata" => "SLZ",
                "city" => "São Luís",
                "abbreviation" => "MA"
            ],
            [
                "name" => "Aeroporto Internacional Marechal Rondon",
                "iata" => "CGB",
                "city" => "Cuiabá",
                "abbreviation" => "MT"
            ],
            [
                "name" => "Aeroporto Internacional de Campo Grande",
                "iata" => "CGR",
                "city" => "Campo Grande",
                "abbreviation" => "MS"
            ],
            [
                "name" => "Aeroporto Internacional Tancredo Neves",
                "iata" => "CNF",
                "city" => "Belo Horizonte",
                "abbreviation" => "MG"
            ],
            [
                "name" => "Aeroporto de Confins - Tancredo Neves",
                "iata" => "PLU",
                "city" => "Belo Horizonte",
                "abbreviation" => "MG"
            ],
            [
                "name" => "Aeroporto Internacional de Belém - Val de Cans",
                "iata" => "BEL",
                "city" => "Belém",
                "abbreviation" => "PA"
            ],
            [
                "name" => "Aeroporto Internacional Presidente Castro Pinto",
                "iata" => "JPA",
                "city" => "João Pessoa",
                "abbreviation" => "PB"
            ],
            [
                "name" => "Aeroporto Internacional Afonso Pena",
                "iata" => "CWB",
                "city" => "Curitiba",
                "abbreviation" => "PR"
            ],
            [
                "name" => "Aeroporto Internacional de Foz do Iguaçu",
                "iata" => "IGU",
                "city" => "Foz do Iguaçu",
                "abbreviation" => "PR"
            ],
            [
                "name" => "Aeroporto Internacional do Recife/Guararapes - Gilberto Freyre",
                "iata" => "REC",
                "city" => "Recife",
                "abbreviation" => "PE"
            ],
            [
                "name" => "Aeroporto Senador Petrônio Portella",
                "iata" => "THE",
                "city" => "Teresina",
                "abbreviation" => "PI"
            ],
            [
                "name" => "Aeroporto Internacional do Rio de Janeiro/Galeão - Antônio Carlos Jobim",
                "iata" => "GIG",
                "city" => "Rio de Janeiro",
                "abbreviation" => "RJ"
            ],
            [
                "name" => "Aeroporto Santos Dumont",
                "iata" => "SDU",
                "city" => "Rio de Janeiro",
                "abbreviation" => "RJ"
            ],
            [
                "name" => "Aeroporto Internacional de Natal - Aluízio Alves",
                "iata" => "NAT",
                "city" => "Natal",
                "abbreviation" => "RN"
            ],
            [
                "name" => "Aeroporto Internacional Salgado Filho",
                "iata" => "POA",
                "city" => "Porto Alegre",
                "abbreviation" => "RS"
            ],
            [
                "name" => "Aeroporto Internacional de Florianópolis",
                "iata" => "FLN",
                "city" => "Florianópolis",
                "abbreviation" => "SC"
            ],
            [
                "name" => "Aeroporto Internacional de Porto Velho",
                "iata" => "PVH",
                "city" => "Porto Velho",
                "abbreviation" => "RO"
            ],
            [
                "name" => "Aeroporto Internacional de Boa Vista - Atlas Brasil Cantanhede",
                "iata" => "BVB",
                "city" => "Boa Vista",
                "abbreviation" => "RR"
            ],
            [
                "name" => "Aeroporto Internacional Hercílio Luz",
                "iata" => "FLN",
                "city" => "Florianópolis",
                "abbreviation" => "SC"
            ],
            [
                "name" => "Aeroporto de Congonhas - Deputado Freitas Nobre",
                "iata" => "CGH",
                "city" => "São Paulo",
                "abbreviation" => "SP"
            ],
            [
                "name" => "Aeroporto Internacional de São Paulo/Guarulhos - Governador André Franco Montoro",
                "iata" => "GRU",
                "city" => "Guarulhos",
                "abbreviation" => "SP"
            ],
            [
                "name" => "Aeroporto Internacional de Viracopos",
                "iata" => "VCP",
                "city" => "Campinas",
                "abbreviation" => "SP"
            ],
            [
                "name" => "Aeroporto de Aracaju - Santa Maria",
                "iata" => "AJU",
                "city" => "Aracaju",
                "abbreviation" => "SE"
            ],
            [
                "name" => "Aeroporto de Palmas - Brigadeiro Lysias Rodrigues",
                "iata" => "PMW",
                "city" => "Palmas",
                "abbreviation" => "TO"
            ],
        ];
        
        foreach($airports as $airport) {
            Airport::create([
                'name' => $airport['name'],
                'iata_code' => $airport['iata'],
                'city' => $airport['city'],
                'abbreviation' => $airport['abbreviation']
            ]);
        }
    }
}
