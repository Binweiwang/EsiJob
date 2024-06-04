<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @include('components.search')
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row justify-between space-y-6 lg:space-y-0 lg:space-x-8">
            <!-- Filtro de trabajos -->
            <div class="flex flex-col bg-white p-6 shadow-md rounded-lg w-full lg:w-1/4">
                @include('jobs.jobFilter')
            </div>

            <!-- Lista de trabajos -->
            <div class="flex-1 bg-white p-6 shadow-md rounded-lg">
                @include('jobs.list')
                <div class="flex items-center justify-center mt-4">
                    {{ $jobs->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    ::-webkit-scrollbar {
        width: 8px;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
        border-radius: 4px;
    }
</style>
