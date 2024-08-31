<div style="padding: 90px">
    <section class="flex items-center font-poppins dark:bg-white-800 ">
        <div class="justify-center flex-1 max-w-6xl px-4 py-4 mx-auto bg-white border rounded-md dark:border-gray-900 dark:bg-gray-900 md:py-10 md:px-10">
          <div>
            <h1 class="px-4 mb-8 text-2xl font-semibold tracking-wide text-green-700 dark:text-green-300 ">
              Obrigado pela preferência! O seu Pedido foi processado. </h1>
            <div class="flex border-b border-gray-200 dark:border-gray-700  items-stretch justify-start w-full h-full px-4 mb-8 md:flex-row xl:flex-col md:space-x-6 lg:space-x-8 xl:space-x-0">
              <div class="flex items-start justify-start flex-shrink-0">
                <div class="flex items-center justify-center w-full pb-6 space-x-4 md:justify-start">
                  <div class="flex flex-col items-start justify-start space-y-2">
                    <p class="text-lg font-semibold leading-4 text-left text-gray-800 dark:text-black-400">
                      {{ $fullName = $pedido->endereco->full_name; }}</p>
                    <p class="text-sm leading-4 text-gray-600 dark:text-gray-400">{{ $pedido->endereco->endereco_rua }}</p>
                    <p class="text-sm leading-4 text-gray-600 dark:text-gray-400">{{ $pedido->endereco->cidade }}, {{ $pedido->endereco->pais }}, {{ $pedido->endereco->caixa_postal }}</p>
                    <p class="text-sm leading-4 cursor-pointer dark:text-gray-400">Telefone: {{ $pedido->endereco->telefone }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200 dark:border-gray-700">
              <div class="w-full px-4 mb-4 md:w-1/4">
                <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                  Pedido Nº:</p>
                <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
                    {{ $pedido->endereco->id }}</p>
              </div>
              <div class="w-full px-4 mb-4 md:w-1/4">
                <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                  Data: </p>
                <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
                    {{ $pedido->endereco->created_at->format('Y-m-d H:i:s') }}
</p>
              </div>
              <div class="w-full px-4 mb-4 md:w-1/4">
                <p class="mb-2 text-sm font-medium leading-5 text-gray-800 dark:text-gray-400 ">
                  Total: </p>
                <p class="text-base font-semibold leading-4 text-blue-600 dark:text-gray-400">
                    {{ Number::currency($pedido->valor_total, 'Kzs') }}</p>
              </div>
              <div class="w-full px-4 mb-4 md:w-1/4">
                <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                  Método de Pagamento: </p>
                <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400 ">
                    {{ $pedido->metodo_de_pagamento == 'pde' ? 'Pagamento pós entrega' : 'Cartão' }} </p>
              </div>
            </div>
            <div class="px-4 mb-10">
              <div class="flex flex-col items-stretch justify-center w-full space-y-4 md:flex-row md:space-y-0 md:space-x-8">
                <div class="flex flex-col w-full space-y-6 ">
                  <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-400">Detalhes do Produto</h2>
                  <div class="flex flex-col items-center justify-center w-full pb-4 space-y-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between w-full">
                      <p class="text-base leading-4 text-gray-800 dark:text-gray-400">Subtotal</p>
                      <p class="text-base leading-4 text-gray-600 dark:text-gray-400">Kzs {{ number_format($pedido->valor_total, 2, ',', '.') }}
                    </p>
                    </div>
                    <div class="flex items-center justify-between w-full">
                      <p class="text-base leading-4 text-gray-800 dark:text-gray-400">Taxas
                      </p>
                      <p class="text-base leading-4 text-gray-600 dark:text-gray-400">Kzs {{ number_format(0, 2, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center justify-between w-full">
                      <p class="text-base leading-4 text-gray-800 dark:text-gray-400">Entrega</p>
                      <p class="text-base leading-4 text-gray-600 dark:text-gray-400">Kzs {{ number_format(0, 2, ',', '.') }}</p>
                    </div>
                  </div>
                  <div class="flex items-center justify-between w-full">
                    <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">Total</p>
                    <p class="text-base font-semibold leading-4 text-gray-600 dark:text-gray-400">{{ Number::currency($pedido->valor_total, 'kzs') }}</p>
                  </div>
                </div>
                <div class="flex flex-col w-full px-2 space-y-4 md:px-8 ">
                  <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-400">Entrega</h2>
                  <div class="flex items-start justify-between w-full">
                    <div class="flex items-center justify-center space-x-2">
                      <div class="w-8 h-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400 bi bi-truck" viewBox="0 0 16 16">
                          <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                          </path>
                        </svg>
                      </div>
                      <div class="flex flex-col items-center justify-start">
                        <p class="text-lg font-semibold leading-6 text-gray-800 dark:text-gray-400">
                            Entrega<br><span class="text-sm font-normal">Entrega em 24 Horas</span>
                        </p>
                      </div>
                    </div>
                    <p class="text-lg font-semibold leading-6 text-gray-800 dark:text-gray-400">00</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-start gap-4 px-4 mt-6 ">
              <a href="{{ route('produtos.index') }}" class="w-full text-center px-4 py-2 text-blue-500 border border-blue-500 rounded-md md:w-auto hover:text-white hover:bg-blue-600 dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-300">
                Continuar a comprar
              </a>
              <a href="{{ route('pedido.index') }}" class="w-full text-center px-4 py-2 bg-blue-500 rounded-md text-gray-50 md:w-auto dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 dark:bg-gray-800">
                Visualizar Pedido
              </a>
            </div>
          </div>
        </div>
    </section>
</div>
