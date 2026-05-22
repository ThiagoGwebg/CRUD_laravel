<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo produto · Estoque</title>
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
                    <span class="current">Novo</span>
                </nav>
            </div>

            <div class="content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Cadastrar produto</h1>
                        <p class="page-sub">Adicione um novo produto ao seu catálogo.</p>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-header">
                        <h2>Informações do produto</h2>
                        <p>Preencha os dados básicos. Você poderá editar depois.</p>
                    </div>

                    <form method="post" action="/produtos">
                        @csrf
                        <div class="form-body">
                            <div class="field">
                                <label class="field-label" for="nome">Nome do produto</label>
                                <div class="input-wrap">
                                    <input class="field-input" type="text" name="nome" id="nome"
                                           placeholder="Ex: Camiseta básica branca" required autofocus>
                                </div>
                                <div class="field-hint">Esse é o nome que aparecerá no catálogo.</div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="preco">Preço de venda</label>
                                <div class="input-wrap">
                                    <span class="input-prefix">R$</span>
                                    <input class="field-input with-prefix" type="number" step="0.01" min="0"
                                           name="preco" id="preco" placeholder="0,00" required>
                                </div>
                                <div class="field-hint">Use ponto para separar centavos (ex: 49.90).</div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="/produtos" class="btn btn-ghost">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Salvar produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
