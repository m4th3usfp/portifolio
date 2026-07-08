<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/curriculo', [PortfolioController::class, 'curriculo'])->name('curriculo');
Route::get('/linkedin', [PortfolioController::class, 'linkedin'])->name('linkedin');
Route::get('/{section}', [PortfolioController::class, 'secao'])->name('secao');
Route::get('/{section}/{depth}', [PortfolioController::class, 'secao'])->name('secao.profundidade');
