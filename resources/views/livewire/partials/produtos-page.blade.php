<div>
<!-- Product -->
<div class="bg0 m-t-23 p-b-140" style="padding-top: 90px">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    Todos os Produtos
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                   Mulheres
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
                    Homens
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".bag">
                    Pastas
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".shoes">
                    Sapatos
                </button>

                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".watches">
                    Relógios
                </button>
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                     Filtrar
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    pesquisar
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                </div>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Marcas
                        </div>

                        @foreach ($marcas as $marca)
                        <ul>
                            <li class="p-b-6" style="display: inline-block; margin-right: 15px;">
                                <input type="checkbox" wire:model.live="selected_marca" id="{{ $marca->slug }}" value="{{ $marca->id }}" style="vertical-align: middle;">
                                <span style="vertical-align: middle; line-height: 1.5;">{{ $marca->nome }}</span>
                            </li>
                        </ul>
                        @endforeach
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Destaques
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <input type="checkbox" wire:model.live="selected_destaques" name="" id="destaque" value="1">
                                    Destaques da loja
                                </input>
                            </li>

                            <li class="p-b-6">
                                <input type="checkbox" wire:model.live="selected_estoque" name="" id="em_estoque" value="1">
                                Em estoque
                                </input>
                            </li>
                            <li class="p-b-6">
                                <input type="checkbox" wire:model.live="selected_venda" name="" id="a_venda" value="1">
                                A Venda
                                </input>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col3 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Categorias
                        </div>
                        {{-- {{ json_encode($selected_categoria) }} --}}
                        @foreach ($categorias as $categoria)
                        <ul>
                            <li class="p-b-6" style="display: inline-block; margin-right: 15px;">
                                <input type="checkbox" wire:model.live="selected_categoria" id="{{ $categoria->slug }}" value="{{ $categoria->id }}" style="vertical-align: middle;">
                                <span style="vertical-align: middle; line-height: 1.5;">{{ $categoria->nome }}</span>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="row isotope-grid">
            @foreach ($produtos as $produto)

            @php
            // Decodifica o JSON para um array associativo
            $imagens = json_decode($produto->imagem, true);  // Acessa corretamente a propriedade 'imagem' do produto

            // Extrai o primeiro caminho de imagem
            $primeiraImagem = !empty($imagens) ? reset($imagens) : null;
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0" style="overflow: hidden; height: 300px;">
                        <a href="{{ route('details.index', ['slug' => $produto->slug]) }}">
                            @if ($primeiraImagem)
                                <!-- Exibe a imagem com tamanho ajustado -->
                                <img src="{{ url('storage', $primeiraImagem) }}" alt="Imagem do Produto" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <!-- Mensagem padrão caso não haja imagem -->
                                <p style="text-align: center; line-height: 300px;">Imagem não disponível</p>
                            @endif
                        </a>

                        <a href="{{ route('details.index', ['slug' => $produto->slug]) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                            visualizar
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{ route('details.index', ['slug' => $produto->slug]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $produto->nome }}
                            </a>

                            <span class="stext-105 cl3">
                                {{ Number::currency($produto->preco, 'Kzs') }}
                            </span>
                        </div>

                        <div class="block2-txt-child2 flex-r p-t-3">
                            <a wire:click.prevent = 'addToCart({{ $produto->id }})' href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <i style="font-size: 30px" class="zmdi zmdi-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#">
                {{ $produtos->links() }}
            </a>
        </div>
    </div>
</div>
</div>
