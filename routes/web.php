<?php

use App\Livewire\Auth\ForgotPage;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPage;
use App\Livewire\Auth\SuccessPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\HomePage;
use App\Livewire\Partials\CancelPage;
use App\Livewire\Partials\CarrinhoPage;
use App\Livewire\Partials\CategoriasPage;
use App\Livewire\Partials\CheckOut;
use App\Livewire\Partials\MeuPedido;
use App\Livewire\Partials\MeuPedidoDetalhesPage;
use App\Livewire\Partials\ProdutoDetailPage;
use App\Livewire\Partials\ProdutosPage;
use App\Livewire\Partials\SuccessPage as PartialsSuccessPage;

Route::get('/', HomePage::class)->name('home.index');
Route::get('/produto/{slug}', HomePage::class)->name('product.details');

Route::get('/categorias', CategoriasPage::class, 'render')->name('categorias.index');
Route::get('/produtos', ProdutosPage::class, 'render')->name('produtos.index');
Route::get('/carrinho', CarrinhoPage::class, 'render')->name('carrinho.index');


Route::get('/produtoDetalhe/{slug}', ProdutoDetailPage::class, 'render')->name('details.index');



Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class, 'render')->name('login');
    Route::get('/register', Register::class, 'render');
    Route::get('/forgot', ForgotPage::class, 'render')->name('password.request');
    Route::get('/reset/{token}', ResetPage::class, 'render')->name('password.reset');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout.index');
    Route::get('/check', CheckOut::class, 'render')->name('ckeck.index');
    Route::get('/pedido', MeuPedido::class, 'render')->name('pedido.index');
    Route::get('/pedido/detalhes/{pedido_id}', MeuPedidoDetalhesPage::class, 'render')->name('pedido.detalhe');
    Route::get('/success', PartialsSuccessPage::class, 'render')->name('success');
    Route::get('/cancel', CancelPage::class, 'render')->name('cancel');
});
