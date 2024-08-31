<?php

use App\Helpers\carrinho_gerenciamento;

$itens_carrinho = carrinho_gerenciamento::obterItens();
$subtotal = carrinho_gerenciamento::calcularValorTotal($itens_carrinho);
$taxas = 0; // Por exemplo, 10% de taxas
$entrega = 0; // Entrega gratuita, ajuste conforme necessário
$total = $subtotal + $taxas + $entrega;

?>

<div class="container mx-auto mt-8" style="padding-top:90px; padding-bottom: 40px">
    <div class="flex flex-wrap -mx-4">
        <div class="md:w-3/4 px-4">
            <h2 style="font-size: 2em; padding-bottom: 20px">Carrinho de Compras</h2>
            <div class="bg-white rounded-lg shadow-md p-6">

                <table class="min-w-full leading-normal">
                  <thead>
                    <tr>
                      <th class="text-left font-semibold">Produtos</th>
                      <th class="text-left font-semibold">Preço</th>
                      <th class="text-left font-semibold">Quantidade</th>
                      <th class="text-left font-semibold">Total</th>
                      <th class="text-left font-semibold">Remover</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(count($itens_carrinho) > 0): ?>
                        <?php foreach ($itens_carrinho as $item): ?>
                        <tr>
                          <td class="py-4">
                            <div class="flex items-center">
                              <span class="font-semibold"><?= htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                          </td>
                          <td class="py-4">Kzs <?= number_format($item['preco'], 2, ',', '.') ?></td>
                          <td class="py-4">
                            <div class="flex items-center">
                              <button wire:click = 'decrementarQTY({{ $item['id_produto'] }})' class="border rounded-md py-2 px-4 mr-2">-</button>
                              <span class="text-center w-8">{{ $item['quantidade'] }}</span>
                              <button wire:click = 'incrementarQTY({{ $item['id_produto'] }})' class="border rounded-md py-2 px-4 ml-2">+</button>
                            </div>
                          </td>
                          <td class="py-4">Kzs <?= number_format($item['valor_total'], 2, ',', '.') ?></td>
                          <td>
                            <button wire:click = "removeItens({{ $item['id_produto']}})" class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                                Remover
                            </button>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Seu carrinho está vazio.</td>
                        </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="md:w-1/4 px-4">
              <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Resumo</h2>
                <div class="flex justify-between mb-2">
                  <span>Subtotal</span>
                  <span>Kzs <?= number_format($subtotal, 2, ',', '.') ?></span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Taxas</span>
                  <span>Kzs <?= number_format($taxas, 2, ',', '.') ?></span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Entrega</span>
                  <span>Kzs <?= number_format($entrega, 2, ',', '.') ?></span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                  <span class="font-semibold">Total</span>
                  <span class="font-semibold">Kzs <?= number_format($total, 2, ',', '.') ?></span>
                </div>
                @if ($itens_carrinho)
                <a href="{{ route('ckeck.index') }}"> <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button></a>
                @endif

              </div>
            </div>
          </div>
        </div>
    </div>
</div>
