<?php

use App\Http\Controllers\FutebolController;
use Illuminate\Support\Facades\Route;

// Página inicial para exibir competições
Route::get('/', [FutebolController::class, 'competicoes'])->name('competicoes.index');

// Seleção de uma competição (POST) para filtrar ou mostrar jogos de uma competição específica
Route::post('/competicoes/selecionar', [FutebolController::class, 'selecionarCompeticao'])->name('competicoes.selecionar');

// Exibir todos os times
Route::get('/times', [FutebolController::class, 'times'])->name('times.index');

// Exibir jogos de um time específico
Route::get('/times/{id}/jogos', [FutebolController::class, 'exibirPartidasDeUmTime'])->name('times.jogos');

// Exibir jogos de uma competição específica
Route::get('/competicoes/{id}/jogos', [FutebolController::class, 'exibirJogos'])->name('competicoes.jogos');

// Exibir detalhes de um time específico (POST pode ser usado se form for necessário para envio de ID)
Route::get('/times/detalhes', [FutebolController::class, 'detalhesTime'])->name('times.detalhes');
