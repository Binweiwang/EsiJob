<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @include('components.search')
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <div class="flex flex-col items-center bg-white overflow-hidden sm:rounded-lg">
                @include('jobs.jobFilter')
            </div>
            <div class="p-6 text-gray-900" style="min-width: 992px">
                @include('jobs.list')
                <div class="flex items-center justify-center mx-auto mt-4">
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
