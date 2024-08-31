<?php

namespace App\Livewire\Partials;

use App\Helpers\carrinho_gerenciamento;
use App\Models\Endereco;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;

#[Title('Checkout')]
class CheckOut extends Component
{

    public $itens_carrinho = [];
    public $subtotal;
    public $taxas;
    public $entrega = 0;
    public $total;
    public $primeiro_nome;
    public $ultimo_nome;
    public $telefone;
    public $endereco_rua;
    public $cidade;
    public $pais;
    public $caixa_postal;
    public $metodo_de_pagamento;
    public $exchange_rate_kz_to_usd = 1 / 1000;

    public function finalizaPedido()
    {

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Converta o total de KZ para USD
        $totalInUsd = ($this->total * $this->exchange_rate_kz_to_usd) / 2;


        // Converta para centavos, pois a Stripe espera valores em centavos
        $totalInCents = round($totalInUsd * 100);


        $this->validate([
            'primeiro_nome' => 'required',
            'ultimo_nome' => 'required',
            'telefone' => 'required',
            'endereco_rua' => 'required',
            'cidade' => 'required',
            'pais' => 'required',
            'caixa_postal' => 'required',
            'metodo_de_pagamento' => 'required',
        ]);

        $itens_carrinho = carrinho_gerenciamento::obterItens();
        $line_itens = [];

        foreach ($itens_carrinho as $itens) {
            $line_itens[] = [
                'price_data' => [
                    'currency' => 'usd',  // Usa USD para Stripe
                    'unit_amount' => $totalInCents,
                    'product_data' => [
                        'name' => $itens['nome'],
                    ],
                ],
                'quantity' => $itens['quantidade'],
            ];
        }

        $pedido = new Pedido();
        $pedido->id_user = Auth::user()->id;
        $pedido->valor_total = carrinho_gerenciamento::calcularValorTotal($itens_carrinho);
        $pedido->metodo_de_pagamento = $this->metodo_de_pagamento;
        $pedido->status_de_pagamento = 'pendente';
        $pedido->status = 'novo';
        $pedido->moeda = 'kzs';  // Kwanza é a moeda original
        $pedido->custo_de_envio = 0;
        $pedido->metodo_de_envio = 'none';
        $pedido->notas = 'Pedido enviado por ' . Auth::user()->name;

        $endereco = new Endereco();
        $endereco->primeiro_nome = $this->primeiro_nome;
        $endereco->ultimo_nome = $this->ultimo_nome;
        $endereco->telefone = $this->telefone;
        $endereco->endereco_rua = $this->endereco_rua;
        $endereco->cidade = $this->cidade;
        $endereco->pais = $this->pais;
        $endereco->caixa_postal = $this->caixa_postal;

        $redirect_url = '';

        if ($this->metodo_de_pagamento == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $sessionChekout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => Auth::user()->email,
                'line_items' => $line_itens,
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),
            ]);

            $redirect_url = $sessionChekout->url;
        } else {
            $redirect_url = route('success');
        }

        $pedido->save();
        $endereco->id_pedido = $pedido->id;
        $endereco->save();
        $pedido->itens()->createMany($itens_carrinho);
        carrinho_gerenciamento::limparItens();

        return redirect($redirect_url);
    }


    public function mount()
    {
        $itens_carrinho = carrinho_gerenciamento::obterItens();
        $this->itens_carrinho = carrinho_gerenciamento::obterItens();
        $this->subtotal = carrinho_gerenciamento::calcularValorTotal($this->itens_carrinho);
        $this->taxas = $this->subtotal * 0;
        $this->total = $this->subtotal + $this->taxas + $this->entrega;

        if (count($itens_carrinho) == 0) {
            return redirect()->route('produtos.index');
        }
    }

    public function render()
    {
        return view('livewire.partials.check-out');
    }
}
