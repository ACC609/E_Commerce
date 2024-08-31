<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto" style="padding: 90px">
    <h1 class="text-4xl font-bold text-slate-500">Meu Pedido</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-black-200 dark:divide-black-700">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Pedido</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Data</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Status do pedido</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Status de pagamento</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Total do pedido</th>
                  <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-black-500 uppercase">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pedido as $pedidos)

                @php
                    $status = '';
                    $status_de_pagamento = '';
                    if($pedidos->status == 'novo'){
                        $status = '<span class="bg-blue-500 py-1 px-3 rounded text-black shadow">novo</span>';
                    }
                    if($pedidos->status == 'processando'){
                        $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-black shadow">processando</span>';
                    }
                    if($pedidos->status == 'enviado'){
                        $status = '<span class="bg-green-300 py-1 px-3 rounded text-black shadow">enviado</span>';
                    }
                    if($pedidos->status == 'entregue'){
                        $status = '<span class="bg-green-500 py-1 px-3 rounded text-black shadow">entregue</span>';
                    }
                    if($pedidos->status == 'cancelado'){
                        $status = '<span class="bg-red-500 py-1 px-3 rounded text-black shadow">cancelado</span>';
                    }
                    if($pedidos->status_de_pagamento == 'pago'){
                        $status_de_pagamento = '<span class="bg-green-500 py-1 px-3 rounded text-black shadow">Pago</span>';
                    }
                    if($pedidos->status_de_pagamento == 'pendente'){
                        $status_de_pagamento = '<span class="bg-orange-500 py-1 px-3 rounded text-black shadow">pendente</span>';
                    }
                    if($pedidos->status_de_pagamento == 'falhado'){
                        $status_de_pagamento = '<span class="bg-orange-500 py-1 px-3 rounded text-black shadow">falhado</span>';
                    }
                @endphp

                <tr class="odd:bg-black even:bg-black-100 dark:odd:bg-slate-900 dark:even:bg-slate-800" wire:key = "{{ $pedidos->id }}">
                  <td class="px-6 py-4 blackspace-nowrap text-sm font-medium text-black-800 dark:text-black-700">{{ $pedidos->id }}</td>
                  <td class="px-6 py-4 blackspace-nowrap text-sm text-black-800 dark:text-black-200">{{ $pedidos->created_at }}</td>
                  <td class="px-6 py-4 blackspace-nowrap text-sm text-black-800 dark:text-black-200">{!! $status !!}</td>
                  <td class="px-6 py-4 blackspace-nowrap text-sm text-black-800 dark:text-black-200">{!! $status_de_pagamento !!}</td>
                  <td class="px-6 py-4 blackspace-nowrap text-sm text-black-800 dark:text-black-200">{{Number::currency($pedidos->valor_total, 'kzs') }}</td>
                  <td class="px-6 py-4 blackspace-nowrap text-end text-sm font-medium">
                    <a href="{{ route('success') }}" class="bg-slate-600 text-black py-2 px-4 rounded-md hover:bg-slate-500">Ver Recibo</a>
                    <a href="{{ route('pedido.detalhe', ['pedido_id' => $pedidos->id]) }}" class="bg-slate-600 text-black py-2 px-4 rounded-md hover:bg-slate-500">Ver Detalhes</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        {{ $pedido->links() }}
      </div>
    </div>
  </div>
