<?php
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ProdutoController::class, "index"]);
Route::get('/produtos/create', [ProdutoController::class, "create"]);
Route::get('/produtos/buscar', [ProdutoController::class, 'buscar']);
Route::post('/produtos', [ProdutoController::class, "store"]);


Route::delete('/produtos/{id}', [ProdutoController::class, "deletar"]);

Route::get('/produtos/{id}/edit', [ProdutoController::class, "edit"]);
Route::put('/produtos/{id}', [ProdutoController::class, "update"]);