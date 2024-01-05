# Airline Ticket System
## Visão Geral

Este é um Sistema Simples de Passagens Aéreas projetado para gerenciar voos, passageiros, passagens e bagagens. O sistema permite que os usuários realizem diversas operações, como criar e modificar voos, comprar passagens e gerenciar informações dos passageiros.

## Requisitos
- PHP 8.2 ou superior
- Laravel 10.x
- MySQL
- Composer instalado globalmente
- Servidor web (por exemplo, Apache ou Nginx)

## Instalação Servidor

#### Transferência de código Fonte:
- Clone ou transfira o código-fonte da sua aplicação para o servidor.

#### Configurações do ambiente:
- Configure o arquivo `.env` com as informações do banco de dados e outras configurações específicas do servidor. Certifique-se de que o ambiente esteja configurado corretamente para produção.

#### Instalção de dependências:

Execute o seguinte comando para instalar as dependências:
```sh
composer install --no-dev
```

#### Configuração do Banco de Dados:

Execute as migrações para criar as tabelas no banco de dados:
```sh
php artisan migrate --seed
```
#### Otimização:
Execute o seguinte comando para otimizar a aplicação para produção:
```sh
php artisan optimize
```

## Instalação Local

 Clone o repositório:

```sh
git clone https://github.com/dandrade96/Horizon-control-system-tickets-baggage.git
```

Navegue até o diretório do projeto:

```sh
cd Horizon-control-system-tickets-baggage
```

Instale as dependências:

```sh
composer install
```

Copie o arquivo .env.example para .env e configure as informações do banco de dados:

```sh
cp .env.example .env
```

Gere a chave da aplicação:

```sh
php artisan key:generate
```

Execute as migrações e popule o banco de dados:

```sh
php artisan migrate --seed
```

## Configuração do Banco de Dados

Esta aplicação utiliza o MySQL como banco de dados. Você pode configurar as informações do banco no arquivo `.env`.

## Endpoints da API

Autenticação:

- `POST /api/login`: Login do usuário.
- `POST /api/logout`: Logout do usuário.

Aeroportos:

- `GET /api/airports`: Visualizar aeroportos.

Voos:

- `GET /api/flights`: Visualiza todos os voos.
- `GET /api/search-flight`: Buscar voo
```json
{
	"origin_airport":"Aeroporto Internacional Marechal Rondon",
	"destination_airport":"Aeroporto Santa Genoveva",
	"departure_date":"2024-01-07"
}
```
`price` é a busca por valor, ele é opcional.

```json
{
	"origin_airport":"Aeroporto Internacional Marechal Rondon",
	"destination_airport":"Aeroporto Santa Genoveva",
	"departure_date":"2024-01-07",
	"price":"3200"
}
```
- `POST /api/flights`: Adicionar voo
```json
{
	"origin_airport_id":12,
	"destination_airport_id":10,
	"departure_datetime":"2024-01-07 15:00",
	"arrival_datetime":"2024-01-07 17:00",
	"classes":[
		{
			"class_name": "Primeira Classe",
			"seat_quantity": 20,
			"seat_price": 2200
		},
		{
			"class_name": "Executiva",
			"seat_quantity": 20,
			"seat_price": 1550
		}
	],
	"airplane_id":3
}
```
- `PUT /api/flights/{id}`: Atualizar Voo
```json
{
	"origin_airport_id":1,
	"destination_airport_id":10,
	"departure_datetime":"2024-01-21 15:00",
	"arrival_datetime":"2024-01-21 17:00",
	"classes":[
		{
			"class_name": "Primeira Classe",
			"seat_quantity": 20,
			"seat_price": 5000
		},
		{
			"class_name": "Executiva",
			"seat_quantity": 20,
			"seat_price": 3000
		}
	],
	"airplane_id":3
}
```
- `GET /api/flight/cancel/{id}`: Cancelar Voo.
- 
## Tickets

- `POST /api/buy-tickets`: Comprar passagem. 
```json
{
	"buyer_name":"Diêgo Andrade",
	"buyer_cpf":"12345678900",
	"buyer_birthday":"1993-04-12",
	"buyer_email":"andrade@example.net",
	"quantity_tickets":1,
	"flight_id": 2,
	"tickets": [
		{
		"passenger_name":"Diêgo Andrade",
		"passenger_cpf":"12345678900",
		"passenger_birthday":"1993-04-12",
		"has_baggage":true,
		"has_dispatch":true,
		"flight_class_id":1
		}
	]
}
```
- `POST /api/emmit-voucher`: Emitir Voucher
```json
{
	"ticket_id":1
}
```
- `POST /api/emmit-baggage`: Emitir Bagagem
```json
{
	"ticket_number":"#65979fabd461c",
	"baggage_number":"#65979fabd5069",
	"passenger_name":"Diêgo Andrade"
}
```

## Autenticação

A aplicação utiliza autenticação baseada em token. Para fazer requisições autenticadas, inclua o token no cabeçalho Authorization:
```sh
Authorization: Bearer SEU_TOKEN
```

## Licença
Este projeto está licenciado sob a Licença MIT.
