<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto · Estoque</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="app">
        @include('partials.sidebar')

        <main class="main">
            <div class="topbar">
                <nav class="breadcrumb">
                    <a href="/produtos">Início</a>
                    <span class="sep">/</span>
                    <a href="/produtos">Produtos</a>
                    <span class="sep">/</span>
                    <span class="current">Editar</span>
                </nav>
            </div>

            <div class="content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Produto</h1>
                        <p class="page-sub">Atualize os dados do produto abaixo.</p>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-header">
                        <h2>{{ $produto->nome }}</h2>
                        <p>#{{ str_pad($produto->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>

                    <form action="/produtos/{{ $produto->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-body">
                            <div class="field">
                                <label class="field-label" for="nome">Nome</label>
                                <input
                                    class="field-input"
                                    type="text"
                                    id="nome"
                                    name="nome"
                                    value="{{ $produto->nome }}"
                                    required
                                >
                            </div>

                            <div class="field">
                                <label class="field-label" for="preco">Preço</label>
                                <div class="input-wrap">
                                    <span class="input-prefix">R$</span>
                                    <input
                                        class="field-input with-prefix"
                                        type="number"
                                        id="preco"
                                        name="preco"
                                        step="0.01"
                                        min="0"
                                        value="{{ $produto->preco }}"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="field">
                                <label class="field-label">Imagem</label>
                                @if($produto->imagem)
                                    <img src="/{{ $produto->imagem }}" class="product-img" style="margin-bottom: 10px;">
                                    <p class="field-hint">Envie uma nova imagem para substituir a atual.</p>
                                @endif
                                <input class="field-input" type="file" name="imagem" accept="image/*">
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="/produtos" class="btn btn-ghost">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
