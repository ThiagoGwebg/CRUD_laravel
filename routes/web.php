<?php
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ ProdutoController::class, "index" ]);
Route::get('/produtos/create', [ ProdutoController::class, "create"]);
Route::post('/produtos', [ ProdutoController::class, "store"]);

Route::delete('/produtos/{id}', [ ProdutoController::class, "deletar" ]);