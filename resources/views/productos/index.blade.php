<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Recargar') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <section>
                <header class="border-b border-gray-200 pb-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ __('Nuestras Opciones') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Explora nuestra colección de opciones y añade los que te gusten al carrito.") }}
                    </p>
                </header>

                <form id="product-form" action="{{ route('carrito.add') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($productos as $index => $producto)
                        <div class="block bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition duration-300 p-6 cursor-pointer" onclick="toggleSelection(this, {{ $index }})">
                            <input type="hidden" name="productos[{{ $index }}][id]" value="{{ $producto->id }}" class="product-id">
                            <input type="checkbox" class="hidden product-checkbox">
                            <div class="text-center">
                                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover rounded-2xl mb-4">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $producto->nombre }}</h3>
                                <p class="mt-2 text-sm text-gray-600">{{ $producto->descripcion }}</p>
                                <p class="mt-2 text-lg font-bold text-gray-900">${{ $producto->precio }}</p>
                                <p class="mt-2 text-sm text-gray-600">{{ __("Créditos : $producto->creditos ") }}</p>
                                <label for="productos[{{ $index }}][quantity]" class="block text-sm font-medium text-gray-700 mt-2">{{ __("Cantidad:") }}</label>
                                <input type="number" name="productos[{{ $index }}][quantity]" value="1" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm product-quantity">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-center">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            {{ __('Añadir al Carrito') }}
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <script>
        document.getElementById('product-form').addEventListener('submit', function (e) {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach((checkbox, index) => {
                if (!checkbox.checked) {
                    const hiddenInputId = document.querySelector(`input[name="productos[${index}][id]"]`);
                    const quantityInput = document.querySelector(`input[name="productos[${index}][quantity]"]`);
                    if (hiddenInputId) hiddenInputId.remove();
                    if (quantityInput) quantityInput.remove();
                }
            });
        });

        function toggleSelection(element, index) {
            const checkbox = element.querySelector(`input[type="checkbox"]`);
            checkbox.checked = !checkbox.checked;

            const hiddenInputId = element.querySelector(`input.product-id`);
            const quantityInput = element.querySelector(`input.product-quantity`);

            if (checkbox.checked) {
                hiddenInputId.disabled = false;
                quantityInput.disabled = false;
                element.classList.add('bg-indigo-100', 'border-indigo-600');
                element.classList.remove('bg-white', 'border-gray-200');
            } else {
                hiddenInputId.disabled = true;
                quantityInput.disabled = true;
                element.classList.add('bg-white', 'border-gray-200');
                element.classList.remove('bg-indigo-100', 'border-indigo-600');
            }
        }
    </script>
</x-app-layout>
