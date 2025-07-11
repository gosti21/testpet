<x-app-layout>
    <div class="mb-16 text-gray-700" x-data="{ pago: 1 }">
        <!-- Corrección importante: grid-cols-1 (no grid-col-1) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Columna izquierda -->
            <div class="col-span-1 bg-white">
                <!-- Se quitó ml-auto porque rompe el diseño de columnas -->
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8">

                    <h1 class="text-2xl font-semibold">
                        Pago
                    </h1>

                    <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                        <ul class="divide-y divide-gray-400 mb-2">
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="1">

                                    <span class="ml-2">
                                        Tarjeta de débito / crédito
                                    </span>

                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png"
                                        alt="">
                                </label>

                                <div class="p-6 bg-gray-100 text-center border-t border-gray-400" x-show="pago == 1">
                                    <!-- Ícono más grande -->
                                    <i class="fa-solid fa-credit-card text-[7rem] text-gray-600 mb-4"></i>

                                    <p>
                                        Luego de hacer click al "Pagar ahora", se abrirá el checkout de Niubiz para
                                        completar tu compra de forma segura.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="2">

                                    <span class="ml-2">
                                        Depósito Bancario o Yape
                                    </span>
                                </label>

                                <div class="p-4 bg-gray-100 flex justify-center border-t border-gray-400" x-cloak
                                    x-show="pago == 2">

                                    <div class="text-sm space-y-1">
                                        <p>1. Pago por depósito o transferencia bancaria</p>
                                        <p>- BCP soles: 198-987654321-98</p>
                                        <p>- CCI: 002-198-987654321</p>
                                        <p>- Razón social: PetShop</p>
                                        <p>- RUC: 209867634</p>
                                        <p>2. Pago por Yape</p>
                                        <p>- Yape al número 987 654 321 (Hugo Astete Arias)</p>
                                        <p>Enviar comprobante de pago al mismo número</p>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-span-1">
                <!-- Se quitó mr-auto -->
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8">

                    <ul class="space-y-4 mb-4">
                        @foreach (Cart::instance('shopping')->content() as $item)
                            <li class="flex items-center space-x-4">
                                <div class="flex-shrink-0 relative">
                                    <img class="h-16 aspect-square" src="{{ $item->options->image }}" alt="">

                                    <div
                                        class="flex justify-center items-center h-6 w-6 bg-gray-900 bg-opacity-70 rounded-full absolute -right-2 -top-2">
                                        <span class="text-white font-semibold">
                                            {{ $item->qty }}
                                        </span>
                                    </div>

                                </div>

                                <div class="flex-1">

                                    <p>
                                        {{ $item->name }}
                                    </p>
                                </div>

                                <div class="flex-shrink-0">
                                    <p>
                                        S/. {{ $item->price }}
                                    </p>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                    <div class="flex justify-between">
                        <p>
                            Subtotal
                        </p>

                        <p>
                            S/. {{ Cart::instance('shopping')->subtotal() }}
                        </p>
                    </div>

                    <div class="flex justify-between">
                        <p>
                            Precio de envio
                            <i class="fas fa-info-circle" title="El precio de envio es de S/5.00"></i>
                        </p>
                        <p>
                            S/. 5.00
                        </p>
                    </div>

                    <hr class="my-3">
                    <div class="flex justify-between mb-4">
                        <p class="text-lg font-semibold">
                            Total
                        </p>

                        <p>
                            S/. {{ Cart::instance('shopping')->subtotal() + 5 }}
                        </p>

                    </div>

                    <div>
                        <button onclick="VisanetCheckout.open()" class="btn btn-blue w-full">
                            Finalizar pedido
                        </button>
                    </div>

                    @if (session('niubiz'))
                        @php
                            $niubiz = session('niubiz');

                            $response = $niubiz['response'];
                            $purchaseNumber = $niubiz['purchaseNumber'];
                        @endphp

                        @isset($response['data'])
                            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                role="alert">

                                <p class="mb-4">
                                    {{ $response['data']['ACTION_DESCRIPTION'] }}
                                </p>

                                <p>
                                    <b>Numero de pedido</b>
                                    <hr>
                                    {{ $purchaseNumber }}
                                </p>

                                <p>
                                    <b>Fecha y hora del pedido</b>

                                    {{ now()->createFromFormat('ymdHis', $response['data']['TRANSACTION_DATE'])->format('d-m-y H:i:s') }}

                                </p>

                                @isset($response['data']['CARD'])

                                <p>
                                    <b>Tarjeta:</b>
                                    {{ $response['data']['CARD'] }} ({{ $response['data']['CARD'] }})
                                </p>
                                @endisset



                            </div>
                        @endisset
                    @endif

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {

                let purchasenumber = Math.floor(Math.random() * 1000000000)
                let amount = {{ Cart::instance('shopping')->subtotal() + 5 }}

                VisanetCheckout.configure({
                    sessiontoken: '{{ $session_token }}',
                    channel: 'web',
                    merchantid: '{{ config('services.niubiz.merchant_id') }}',
                    purchasenumber: purchasenumber,
                    amount: amount,
                    expirationminutes: '20',
                    timeouturl: 'about:blank',
                    merchantlogo: 'img/comercio.png',
                    formbuttoncolor: '#000000',
                    action: "{{ route('checkout.paid') }}?amount=" + amount + "&purchasenumber=" +
                        purchasenumber,
                    complete: function(params) {
                        alert(JSON.stringify(params));
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
