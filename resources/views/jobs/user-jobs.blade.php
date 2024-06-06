<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Mis Ofertas de Trabajo') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <section>
                <header class="border-b border-gray-200 pb-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ __('Ofertas de Trabajo Publicadas') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Aquí puedes ver todas las ofertas de trabajo que has publicado.") }}
                    </p>
                </header>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($jobs as $job)
                    <a href="{{ route('jobs.edit', $job) }}" class="text-gray-900 hover:text-gray-600">

                        <div
                            class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    {{ $job->title }}
                                </h3>
                                <p class="mt-2 text-sm text-gray-600">{{ Str::limit($job->description, 100) }}</p>
                                <p class="mt-2 text-sm text-gray-600"><strong>{{ __('Requisitos:') }}</strong> {{
                                    Str::limit($job->requirements, 80) }}</p>
                                <p class="mt-2 text-sm text-gray-600"><strong>{{ __('Salario:') }}</strong> {{
                                    $job->salary }}</p>
                                <p class="mt-2 text-sm text-gray-600"><strong>{{ __('Ubicación:') }}</strong> {{
                                    ucfirst($job->location) }}</p>
                                <p class="mt-2 text-sm text-gray-600"><strong>{{ __('Jornada:') }}</strong>
                                    @if($job->workday == 'full-time')
                                    {{ __('Jornada Completa') }}
                                    @elseif($job->workday == 'part-time')
                                    {{ __('Jornada Parcial') }}
                                    @elseif($job->workday == 'remote')
                                    {{ __('Remoto') }}
                                    @endif
                                </p>
                            </div>
                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="flex items-center justify-center mb-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold text-center rounded-lg py-2 px-4">
                                    {{ __('Eliminar') }}
                                </button>
                            </form>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                        <p class="text-sm text-gray-600">{{ __('No has publicado ninguna oferta de trabajo aún.') }}</p>
                    </div>
                    @endforelse
                </div>
                <div class="flex items-center justify-between my-4">
                    <div class="w-1/2">
                        {{ $jobs->links() }}
                    </div>

                    <div class="w-1/2 text-right">
                        <a href="{{ route('jobs.create') }}"
                           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold text-center rounded-lg py-2 px-4">
                            {{ __('Publicar Oferta de Trabajo') }}
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
