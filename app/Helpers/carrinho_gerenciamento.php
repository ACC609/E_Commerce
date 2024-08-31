<?php

namespace App\Helpers;

use App\Models\Produto;
use Illuminate\Support\Facades\Cookie;

class carrinho_gerenciamento
{
    // Adicionar itens ao carrinho
    static public function addItens($id_produto)
    {
        $itens_carrinho = self::obterItens();
        $existing_item = null;

        foreach ($itens_carrinho as $key => $itens) {
            if ($itens['id_produto'] == $id_produto) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $itens_carrinho[$existing_item]['quantidade']++;
            $itens_carrinho[$existing_item]['valor_total'] = $itens_carrinho[$existing_item]['quantidade'] * $itens_carrinho[$existing_item]['preco'];
        } else {
            $produto = Produto::where('id', $id_produto)->first(['id', 'nome', 'preco', 'imagem']);
            if ($produto) {
                $itens_carrinho[] = [
                    'id_produto' => $id_produto,
                    'nome' => $produto->nome,
                    'imagem' => $produto->imagem, // Assumindo que é uma string JSON
                    'quantidade' => 1,
                    'preco' => $produto->preco,
                    'valor_total' => $produto->preco
                ];
            }
        }

        // Atualizar o carrinho no cookie
        self::addItensCarrinho($itens_carrinho);
        return count($itens_carrinho);
    }

    // Remover itens do carrinho
    static public function removerItens($id_produto)
    {
        $itens_carrinho = self::obterItens();

        foreach ($itens_carrinho as $key => $itens) {
            if ($itens['id_produto'] == $id_produto) {
                unset($itens_carrinho[$key]);
            }
        }

        // Atualizar o carrinho no cookie
        self::addItensCarrinho($itens_carrinho);
        return $itens_carrinho;
    }

    // Adicionar itens ao carrinho no cookie
    static public function addItensCarrinho($itens_carrinho)
    {
        Cookie::queue('itens_carrinho', json_encode($itens_carrinho), 60 * 24 * 30);
    }

    // Limpar itens do carrinho no cookie
    static public function limparItens()
    {
        Cookie::queue(Cookie::forget('itens_carrinho'));
    }

    // Obter todos os itens do carrinho no cookie
    static public function obterItens()
    {
        $itens_carrinho = json_decode(Cookie::get('itens_carrinho'), true);

        if (!$itens_carrinho) {
            $itens_carrinho = [];
        }
        return $itens_carrinho;
    }

    // Incrementar a quantidade de itens
    static public function incrementarQuantidade($id_produto)
    {
        $itens_carrinho = self::obterItens();
        foreach ($itens_carrinho as $key => $itens) {
            if ($itens['id_produto'] == $id_produto) {
                $itens_carrinho[$key]['quantidade']++;
                $itens_carrinho[$key]['valor_total'] = $itens_carrinho[$key]['quantidade'] * $itens_carrinho[$key]['preco'];
            }
        }
        // Atualizar o carrinho no cookie
        self::addItensCarrinho($itens_carrinho);
        return $itens_carrinho;
    }

    // Decrementar a quantidade de itens
    static public function decrementarQuantidade($id_produto)
    {
        $itens_carrinho = self::obterItens();
        foreach ($itens_carrinho as $key => $itens) {
            if ($itens['id_produto'] == $id_produto) {
                if ($itens_carrinho[$key]['quantidade'] > 1) {
                    $itens_carrinho[$key]['quantidade']--;
                    $itens_carrinho[$key]['valor_total'] = $itens_carrinho[$key]['quantidade'] * $itens_carrinho[$key]['preco'];
                }
            }
        }
        // Atualizar o carrinho no cookie
        self::addItensCarrinho($itens_carrinho);
        return $itens_carrinho;
    }

    // Calcular o valor total
    static public function calcularValorTotal($itens)
    {
        return array_sum(array_column($itens, 'valor_total'));
    }
}
