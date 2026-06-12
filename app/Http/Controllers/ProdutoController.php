<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view("index", ["produtos" => $produtos, "busca" => null]);
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
        if ($request->hasFile('imagem')) {
            $pasta = public_path('images/produtos');
            if (!is_dir($pasta)) {
                mkdir($pasta, 0755, true);
            }
            $extensaoImagem = $request->file('imagem')->getClientOriginalExtension();
            $nomeImagem = uniqid() . '.' . $extensaoImagem;
            $dados['imagem'] = "images/produtos/$nomeImagem";
            $request->file('imagem')->move($pasta, $nomeImagem);

        }

        Produto::create($dados);
        // Redirecionando para a página de produtos
        return redirect()
            ->to("/produtos")
            ->with("success", "Produto criado com sucesso!");
    }

    public function deletar($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->to("produtos")->with("sucesso", "Produto removido com sucesso");
    }

    public function buscar(Request $request)
    {
        $busca = $request->input('busca', '');

        if (empty($busca)) {
            return redirect('/produtos');
        }

        $produtos = Produto::where('nome', 'like', '%' . $busca . '%')->get();

        return view("index", ["produtos" => $produtos, "busca" => $busca]);

    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view("edit", ["produto" => $produto]);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $dados = $request->only(["nome", "preco"]);

        if ($request->hasFile('imagem')) {
            $pasta = public_path('images/produtos');
            if (!is_dir($pasta)) {
                mkdir($pasta, 0755, true);
            }
            $extensaoImagem = $request->file('imagem')->getClientOriginalExtension();
            $nomeImagem = uniqid() . '.' . $extensaoImagem;
            $dados['imagem'] = "images/produtos/$nomeImagem";
            $request->file('imagem')->move($pasta, $nomeImagem);
        }

        $produto->update($dados);

        return redirect("/produtos")->with("success", "Produto atualizado com sucesso!");
    }

}
