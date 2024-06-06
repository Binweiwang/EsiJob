<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Pago Cancelado') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <section>
                <header class="border-b border-gray-200 pb-4">
                    <h2 class="text-2xl font-semibold text-gray-900">
                        {{ __('El pago ha sido cancelado') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Has cancelado el proceso de pago. Si esto ha sido un error, puedes intentar nuevamente.") }}
                    </p>
                </header>

                <div class="mt-6">
                    <p class="text-lg text-gray-800">
                        {{ __("Si necesitas ayuda, por favor contacta con nuestro equipo de soporte.") }}
                    </p>
                    <div class="mt-6 text-center">
                        <a href="{{ route('home') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-500">
                            {{ __('Volver al Inicio') }}
                        </a>
                        <a href="{{ route('checkout') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-500 ml-4">
                            {{ __('Intentar nuevamente') }}
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
