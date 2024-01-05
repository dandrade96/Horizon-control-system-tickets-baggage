<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TicketController;

// Rotas para autenticação
Route::post('/login', [ LoginController::class, 'login' ]);
Route::post('/logout', [ LoginController::class, 'logout' ])->middleware('auth:sanctum');

// Rotas para aeroportos
Route::get('/airports', [ AirportController::class, 'index' ]);

// Rotas para o voo
Route::get('/flights', [ FlightController::class, 'index' ]);
Route::get('/buscar-voo', [ FlightController::class, 'show' ]);
Route::post('/flights', [ FlightController::class, 'store' ]);
Route::put('/flights/{id}', [ FlightController::class, 'update' ]);
Route::get('/flight/cancel/{id}', [ FlightController::class, 'cancelFlight']);

// Rotas para passagem, bagagem e emissões
Route::post('/buy-tickets', [ TicketController::class, 'store' ]);
Route::post('/emmit-voucher', [ TicketController::class, 'emmitVoucher']);
Route::post('/emmit-baggage', [ TicketController::class, 'emmitBaggage']);