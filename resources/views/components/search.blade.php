<div class="rounded-lg p-5">
    <form action="{{ route('home') }}" method="GET">
        <div class="flex items-center bg-white-500 rounded-full shadow-lg w-full">
            <div class="flex items-center px-4 py-2 rounded-l-full bg-white flex-grow">
                <i class="fas fa-search text-gray-400 mr-2"></i>
                <input type="text" name="search" class="w-full border-none focus:outline-none focus:ring-0 text-gray-800" placeholder="Título del trabajo o palabra clave">
            </div>
            <div class="flex items-center px-4 py-2 bg-white flex-grow">
                <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                <select name="location" class="border-none focus:outline-none focus:ring-0 text-gray-800 w-full">
                    <option value="">Selecciona Provincia</option>
                    @foreach($provinces as $province)
                    <option value="{{ strtolower($province) }}" {{ request('location') == strtolower($province) ? 'selected' : '' }}>
                    {{ $province }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="px-4 py-2 rounded-r-full bg-white">
                <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-full">Buscar</button>
            </div>
        </div>
    </form>
</div>
