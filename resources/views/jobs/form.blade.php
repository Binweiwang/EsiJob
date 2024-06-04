<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ isset($job) ? __('Editar Oferta de Trabajo') : __('Publicar Oferta de Trabajo') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white overflow-hidden shadow-md rounded-lg p-6">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Información de la Oferta de Trabajo') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Completa los campos a continuación para publicar una nueva oferta de trabajo.") }}
                    </p>
                </header>

                <form method="post" action="{{ isset($job) ? route('jobs.update', $job) : route('jobs.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @if(isset($job))
                    @method('PUT')
                    @endif                    <div>
                        <x-input-label for="title" :value="__('Título del Trabajo')"/>
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                      :value="isset($job) ? $job->title : old('title')" required autofocus autocomplete="title"/>
                        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Descripción')"/>
                        <textarea id="description" name="description" class="mt-1 block w-full rounded-md shadow-sm"
                                  rows="5" required>{{ isset($job) ? $job->description : old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                    </div>

                    <div>
                        <x-input-label for="requirements" :value="__('Requisitos')"/>
                        <textarea id="requirements" name="requirements" class="mt-1 block w-full rounded-md shadow-sm"
                                  rows="3" required>{{ isset($job) ? $job->requirements : old('requirements') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('requirements')"/>
                    </div>

                    <div>
                        <x-input-label for="salary" :value="__('Salario')"/>
                        <x-text-input id="salary" name="salary" type="text" class="mt-1 block w-full"
                                      :value="isset($job) ? $job->salary : old('salary')" required autocomplete="salary"/>
                        <x-input-error class="mt-2" :messages="$errors->get('salary')"/>
                    </div>

                    <div>
                        <x-select-label id="location" name="location" class="mt-1 block w-full" value="Selecciona Provincia" required>
                            <option value="">Selecciona Provincia</option>
                            @foreach($provinces as $province)
                            <option value="{{ strtolower($province) }}" {{ isset($job) && strtolower($job->location) == strtolower($province) ? 'selected' : '' }}>
                                {{ $province }}
                            </option>
                            @endforeach
                        </x-select-label>
                        <x-input-error class="mt-2" :messages="$errors->get('location')"/>
                    </div>

                    <div>
                        <x-select-label id="workdays" name="workday" class="mt-1 block w-full" value="Selecciona Jornada Laboral" required>
                            <option value="">Selecciona Jornada Laboral</option>
                            <option value="full-time" {{ isset($job) && $job->workday == 'full-time' ? 'selected' : '' }}>Jornada Completa</option>
                            <option value="part-time" {{ isset($job) && $job->workday == 'part-time' ? 'selected' : '' }}>Jornada Parcial</option>
                            <option value="remote" {{ isset($job) && $job->workday == 'remote' ? 'selected' : '' }}>Remoto</option>
                        </x-select-label>
                    </div>

                    <!-- Campo para subir el logotipo de la empresa (company_logo) -->
                    <div class="mt-4">
                        <x-input-label for="company_logo" :value="__('Logotipo de la Empresa')"/>
                        <x-file-input id="company_logo" name="company_logo" class="mt-1 block w-full"/>
                        <x-input-error class="mt-2" :messages="$errors->get('company_logo')"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="mr-4 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            <a href="{{ url()->previous() }}">
                                {{ __('Volver') }}
                            </a>
                            </x-button>
                            <x-button class="ml-4">
                                {{ isset($job) ? __('Actualizar Oferta de Trabajo') : __('Publicar Oferta de Trabajo') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
