<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view("index",["produtos" => $produtos]);
    }

    public function create()
    {
        return view("create");
    }
    public function store(Request $request)
    {
        // Pegando dados do formulário
        $dados = $request->only(["nome", "preco"]);
        // 
        Produto::create($dados);
        // Redirecionando para a página de produtos
        return redirect()
        ->to("/produtos")
        ->with("success", "Produto criado com sucesso!");
    }

}
