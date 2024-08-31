<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto" style="padding: 90px">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
            Checkout
        </h1>
        <form wire:submit.prevent='finalizaPedido'>



            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-12 lg:col-span-8 col-span-12">
                    <!-- Card -->
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-white-900">
                        <!-- Shipping Address -->
                        <div class="mb-6">
                            <h2 class="text-xl font-bold underline text-gray-700 dark:text-black mb-2">
                                Endereço de Entrega
                            </h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 dark:text-black mb-1" for="first_name">
                                        Primeiro Nome
                                    </label>
                                    <input wire:model="primeiro_nome" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="first_name" type="text">
                                    </input>

                                   @error('primeiro_nome')
                                   <div class="text-red-500 text-sm">{{ $message }}</div>
                                   @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 dark:text-black mb-1" for="last_name">
                                        Último nome
                                    </label>
                                    <input wire:model="ultimo_nome" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="last_name" type="text">
                                    </input>
                                    @error('ultimo_nome')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-black mb-1" for="phone">
                                    Telefone
                                </label>
                                <input wire:model="telefone" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="phone" type="text">
                                </input>
                                @error('telefone')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-black mb-1" for="address">
                                    Endereço de entrega
                                </label>
                                <input wire:model="endereco_rua" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="address" type="text">
                                </input>
                                @error('endereco_rua')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-black mb-1" for="city">
                                    Cidade
                                </label>
                                <input wire:model="cidade" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="city" type="text">
                                </input>
                                @error('cidade')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-gray-700 dark:text-black mb-1" for="state">
                                        País
                                    </label>
                                    <input wire:model="pais" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="state" type="text">
                                    </input>
                                    @error('pais')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 dark:text-black mb-1" for="zip">
                                        Caixa Postal
                                    </label>
                                    <input wire:model="caixa_postal" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="zip" type="text">
                                    </input>
                                    @error('caixa_postal')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-lg font-semibold mb-4">
                            Selecione o método de pagamento
                        </div>
                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            <li>
                                <input wire:model= "metodo_de_pagamento" class="hidden peer" id="hosting-small" required="" type="radio" value="pde" />
                                <label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-small">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">
                                            Pagamento pós entrega
                                        </div>
                                    </div>
                                    <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        </path>
                                    </svg>
                                </label>
                            </li>
                            <li>
                                <input wire:model= "metodo_de_pagamento" class="hidden peer" id="hosting-big" name="hosting" type="radio" value="stripe">
                                <label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-big">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">
                                            Stripe
                                        </div>
                                    </div>
                                    <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        </path>
                                    </svg>
                                </label>
                                </input>
                            </li>
                        </ul>
                        @error('metodo_de_pagamento')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Card -->
                </div>
                <div class="md:col-span-12 lg:col-span-4 col-span-12">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <div class="text-xl font-bold underline text-gray-700 dark:text-black mb-2">
                            RESUMO DO PEDIDO
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                Subtotal
                            </span>
                            <span>
                                Kzs {{ number_format($subtotal, 2, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                Taxes
                            </span>
                            <span>
                                Kzs {{ number_format($taxas, 2, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                Shipping Cost
                            </span>
                            <span>
                                Kzs {{ number_format($entrega, 2, ',', '.') }}
                            </span>
                        </div>
                        <hr class="bg-slate-400 my-4 h-1 rounded">
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                Grand Total
                            </span>
                            <span>
                                Kzs {{ number_format($total, 2, ',', '.') }}
                            </span>
                        </div>
                        </hr>
                    </div>
                    <button type="submit" class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                        <span wire.loading.remove>Finalizar Pedido</span>
                        <span wire:loading>Processando....</span>
                    </button>
                    <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <div class="text-xl font-bold underline text-gray-700 dark:text-black mb-2">
                            RESUMO DO CARRINHO
                        </div>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                            @foreach ($itens_carrinho as $item)
                            <li class="py-3 sm:py-4" wire:key='{{$item['id_produto']}}'>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <p class="text-sm font-medium text-black-900 truncate dark:text-black">
                                            {{ $item['nome'] }}
                                        </p>
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                                            {{ $item['nome'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            Quantidade: {{ $item['quantidade'] }}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-black">
                                        Kzs {{ number_format($item['valor_total'], 2, ',', '.') }}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
