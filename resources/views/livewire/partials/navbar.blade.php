<div>
    <header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						Frete grátis para pedidos padrão acima de 5000kzs
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Ajuda e Perguntas Frequentes
						</a>

						@guest
                        <a href="/login" class="flex-c-m trans-04 p-lr-25">
							Login
						</a>

						<a href="/register" class="flex-c-m trans-04 p-lr-25">
							Cadastrar
						</a>
                        @endguest

                        @auth
                            <a href="#" class="flex-c-m trans-04 p-lr-25">
                                {{ auth()->User()->name }}
                            </a>
                            <!-- Link para Terminar Sessão -->
                            <a href="/logout" class="flex-c-m trans-04 p-lr-25"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Terminar sessão
                         </a>

                         <!-- Formulário Invisível -->
                         <form id="logout-form" action="{{ route('logout.index') }}" method="POST" style="display: none;">
                             @csrf
                         </form>

                        @endauth

						<a href="{{route('pedido.index')}}" class="flex-c-m trans-04 p-lr-25">
							Meus Pedidos
						</a>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="#" class="logo">
						<img src="{{asset('images/icons/logo-01.png')}}" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu" >
								<a href="{{ route('home.index') }}" >Home</a>
							</li>

							<li  class="label1" data-label1="hot">
								<a href="{{ route('produtos.index') }}" >Loja</a>
							</li>
							<li>
								<a href="{{ route('carrinho.index') }}">Carrinho</a>
							</li>

							<li>
								<a href="#">Blog</a>
							</li>

							<li>
								<a href="#">Sobre Nós</a>
							</li>

							<li>
								<a href="#" wire:navigate>Contact</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>
                        <a href="{{ route('carrinho.index') }}">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{ $valor_total }}">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
                        </a>
						<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="index.html"><img src="{{asset('images/icons/logo-01.png')}}" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Entrega Gratuita
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						@guest
                        <a href="/login" class="flex-c-m trans-04 p-lr-25">
							Login
						</a>

						<a href="/register" class="flex-c-m trans-04 p-lr-25">
							Cadastrar
						</a>
                        @endguest

                        @auth
                            <a href="#" class="flex-c-m trans-04 p-lr-25">
                                {{ auth()->User()->name }}
                            </a>
                            <!-- Link para Terminar Sessão -->
                            <a href="/logout" class="flex-c-m trans-04 p-lr-25"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Terminar sessão
                         </a>

                         <!-- Formulário Invisível -->
                         <form id="logout-form" action="{{ route('logout.index') }}" method="POST" style="display: none;">
                             @csrf
                         </form>

                        @endauth

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							KZS
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="{{ route('home.index') }}">Home</a>
				</li>

				<li>
					<a href="{{ route('produtos.index') }}">Loja</a>
				</li>

				<li>
					<a href="{{ route('carrinho.index') }}">Carrinho</a>
				</li>

				<li>
					<a href="#">Blog</a>
				</li>

				<li>
					<a href="#">About</a>
				</li>

				<li>
					<a href="#">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="{{asset('images/icons/icon-close2.png')}}" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>
</div>
