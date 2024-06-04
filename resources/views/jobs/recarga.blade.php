<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Recargar Créditos') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <section>
                <header class="border-b border-gray-200 pb-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ __('Opciones de Recarga') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Selecciona una opción para recargar tus créditos.") }}
                    </p>
                </header>

                <form action="{{ url('/credits') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach([5, 10, 20, 50, 100, 200, 500] as $amount)
                        <label class="block bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition duration-300 p-6 cursor-pointer">
                            <input type="radio" name="amount" value="{{ $amount }}" class="hidden">
                            <div class="text-center">
                                <h3 class="text-xl font-semibold text-gray-900">${{ $amount }}</h3>
                                <p class="mt-2 text-sm text-gray-600">{{ __("Obtener $amount créditos") }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    <div class="mt-6 text-center">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            {{ __('Recargar Créditos') }}
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <h3 class="text-xl font-semibold text-gray-900">{{ __('Saldo Actual:') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ Auth::user()->credits }} {{ __('créditos') }}</p>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
