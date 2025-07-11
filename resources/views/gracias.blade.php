<x-app-layout>

    <div class="max-w-3xl mx-auto pt-12">
        <img class="w-full" src="https://d1ih8jugeo2m5m.cloudfront.net/2024/01/gracias-por-tu-compra-minimalista.jpg"
            alt="">

        @if (session('niubiz'))
            @php

                $response = session('niubiz');

            @endphp

            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div>
                    <p>
                        {{ $response['dataMap']['ACTION_DESCRIPTION'] }}
                    </p>

                    <p>
                        <b>
                            Numero de pedido
                        </b>
                        {{ $response['order']['purchaseNumber'] }}
                    </p>
                    <p>
                        <b>Fecha y hora del pedido</b>
                        {{ now()->createFromFormat('ymdHis', $response['dataMap']['TRANSACTION_DATE'])->format('d-m-y H:i:s') }}
                    </p>

                    <p>
                        <b>Tarjeta:</b>
                        {{$response['dataMap']['CARD']}} ({{$response['dataMap']['CARD']}})
                    </p>

                    <p>
                        <b>Importe</b>
                        {{$response['order']['amount']}} {{$response['order']['currency']}}
                    </p>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
