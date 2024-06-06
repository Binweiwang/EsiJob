<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <section>
                <header class="border-b border-gray-200 pb-4">
                    <h2 class="text-2xl font-semibold text-gray-900">
                        {{ __('Tus artículos en el carrito') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Revisa y gestiona los artículos en tu carrito.") }}
                    </p>
                </header>

                <div class="mt-6">
                    @if($cartItems->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($cartItems as $item)
                        <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden p-4">
                            <div class="flex items-center justify-center">
                                <img src="{{ $item->producto->imagen }}" alt="{{ $item->producto->name }}" class="w-32 h-32 object-cover rounded-lg">
                            </div>
                            <div class="mt-4 text-center">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $item->producto->name }}</h3>
                                <p class="mt-2 text-sm text-gray-600">{{ $item->producto->descripcion }}</p>
                                <p class="mt-2 text-lg font-bold text-gray-900">${{ $item->producto->precio }}</p>
                                <p class="mt-2 text-sm text-gray-600">{{ __("Créditos: ") }}{{ $item->producto->creditos }}</p>
                            </div>
                            <div class="mt-4">
                                <form action="{{ route('carrito.update') }}" method="POST" class="flex items-center justify-center quantity-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->producto_id }}">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mr-2">{{ __("Cantidad:") }}</label>
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 p-1 border-gray-300 rounded-md text-center quantity-input" data-price="{{ $item->producto->precio }}">
                                </form>
                                <p class="mt-2 text-sm text-gray-600">{{ __("Total: $") }}<span class="total-price">{{ $item->quantity * $item->producto->precio }}</span></p>
                            </div>
                            <div class="mt-4 text-center">
                                <form action="{{ route('carrito.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->producto_id }}">
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-500">
                                        {{ __('Eliminar') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-center">
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-500">
                                {{ __('Proceder al Pago') }}
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="text-center">
                        <p class="mt-2 text-sm text-gray-600">{{ __("No tienes artículos en tu carrito.") }}</p>
                    </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <script>
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', async function() {
                const price = this.dataset.price;
                const quantity = this.value;
                const totalPriceElement = this.closest('.flex.flex-col').querySelector('.total-price');
                totalPriceElement.textContent = (price * quantity).toFixed(2);

                try {
                    const form = this.closest('form');
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        console.error('Failed to update quantity');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
</x-app-layout>
