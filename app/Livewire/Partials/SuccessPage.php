<?php

namespace App\Livewire\Partials;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class SuccessPage extends Component
{
    #[Url()]
    public $session_id;

    public $ultimo_pedido;

    public function mount()
    {
        // Obtém o último pedido do usuário autenticado
        $this->ultimo_pedido = Pedido::with('endereco')
            ->where('id_user', Auth::user()->id)
            ->latest()
            ->first();

        if ($this->session_id) {
            // Define a chave de API da Stripe
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Recupera as informações da sessão de pagamento da Stripe
            $session_info = Session::retrieve($this->session_id);

            // Verifica o status do pagamento
            if ($session_info->payment_status != 'paid') {
                $this->ultimo_pedido->status_de_pagamento = 'failed';
                $this->ultimo_pedido->save();

                // Redireciona para a rota de cancelamento
                return redirect()->route('cancel');
            } elseif ($session_info->payment_status == 'paid') {
                $this->ultimo_pedido->status_de_pagamento = 'pago';
                $this->ultimo_pedido->save();

                // Redireciona para a rota de sucesso
                return redirect()->route('success');
            }
        }
    }

    public function render()
    {
        // Retorna a view com os dados do pedido
        return view('livewire.partials.success-page', [
            'pedido' => $this->ultimo_pedido,
        ]);
    }
}
