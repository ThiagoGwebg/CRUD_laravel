<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos · Estoque</title>
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
                    <span class="current">Produtos</span>
                </nav>

                <form class="search-form" action="/produtos/buscar" method="get">
                    <div class="search-form-input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" name="busca" placeholder="Buscar produto..." value="{{ $busca ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-ghost">Buscar</button>
                    @if($busca ?? false)
                        <a class="btn btn-ghost" href="/produtos">Limpar</a>
                    @endif
                </form>

                <a href="/produtos/create" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Novo produto
                </a>
            </div>

            <div class="content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Produtos</h1>
                        <p class="page-sub">Gerencie o catálogo de produtos da sua loja.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @php
                    $total = count($produtos);
                    $somaPrecos = $produtos->sum('preco');
                    $precoMedio = $total > 0 ? $somaPrecos / $total : 0;
                @endphp

                <div class="stats">
                    <div class="stat">
                        <div class="stat-header">
                            <span class="stat-label">Total de produtos</span>
                            <div class="stat-icon indigo">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">{{ $total }}</div>
                        <div class="stat-trend">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round" width="12" height="12">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                                <polyline points="17 6 23 6 23 12" />
                            </svg>
                            Catálogo ativo
                        </div>
                    </div>

                    <div class="stat">
                        <div class="stat-header">
                            <span class="stat-label">Valor total</span>
                            <div class="stat-icon green">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">R$ {{ number_format($somaPrecos, 2, ',', '.') }}</div>
                        <div class="stat-trend">Somatório do catálogo</div>
                    </div>

                    <div class="stat">
                        <div class="stat-header">
                            <span class="stat-label">Preço médio</span>
                            <div class="stat-icon amber">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="20" x2="18" y2="10" />
                                    <line x1="12" y1="20" x2="12" y2="4" />
                                    <line x1="6" y1="20" x2="6" y2="14" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">R$ {{ number_format($precoMedio, 2, ',', '.') }}</div>
                        <div class="stat-trend">Por produto</div>
                    </div>
                </div>

                <div class="section-header">
                    <div class="section-title">Catálogo</div>
                    <span class="section-count">{{ $total }} {{ $total === 1 ? 'item' : 'itens' }}</span>
                </div>

                @if ($total > 0)
                    <div class="grid">
                        @foreach ($produtos as $produto)
                            <article class="product-card">
                                <div class="card-top">
                                    <div class="product-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                            <line x1="3" y1="6" x2="21" y2="6" />
                                            <path d="M16 10a4 4 0 0 1-8 0" />
                                        </svg>
                                    </div>
                                    <span class="badge">Disponível</span>
                                </div>

                                @if($produto->imagem)
                                    <img src="/{{ $produto->imagem }}" class="product-img">
                                @endif

                                <h3 class="product-name">{{ $produto->nome }}</h3>
                                <div class="product-id">#{{ str_pad($produto->id, 4, '0', STR_PAD_LEFT) }}</div>

                                <div class="card-footer">
                                    <div class="product-price">
                                        <span class="currency">R$</span>{{ number_format($produto->preco, 2, ',', '.') }}
                                    </div>
                                    <div class="product-date">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                            <line x1="16" y1="2" x2="16" y2="6" />
                                            <line x1="8" y1="2" x2="8" y2="6" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                        </svg>
                                        {{ $produto->created_at->format('d/m/Y') }}
                                    </div>
                                </div>

                                <div class="card-actions">
                                    <a href="/produtos/{{ $produto->id }}/edit" class="btn btn-ghost btn-full">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                        Editar
                                    </a>
                                    <form action="/produtos/{{ $produto->id }}" method="post"
                                        onsubmit="return confirm('Deseja excluir este produto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-full">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M10 11v6M14 11v6" />
                                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                            </svg>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty">
                        <div class="empty-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                <line x1="12" y1="22.08" x2="12" y2="12" />
                            </svg>
                        </div>
                        <div class="empty-title">Nenhum produto ainda</div>
                        <div class="empty-text">Comece cadastrando seu primeiro produto no catálogo.</div>
                        <a href="/produtos/create" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Cadastrar produto
                        </a>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>

</html>
