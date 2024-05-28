<div x-data="{ fileName: '' }" class="relative flex items-center justify-center w-full mt-1 border-2 border-dashed border-gray-300 rounded-md shadow-sm hover:border-indigo-500 focus-within:border-indigo-500 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
    <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" {{ $attributes }}
           @change="fileName = $event.target.files[0].name">
    <div class="flex flex-col items-center space-y-1">
        <svg x-show="!fileName" class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C8.14 2 5 5.14 5 9c0 2.5 1.21 4.69 3.11 6.11L12 22l3.89-6.89C17.79 13.69 19 11.5 19 9c0-3.86-3.14-7-7-7zm0 14.54L10.26 12.81C8.83 11.93 8 10.53 8 9c0-2.21 1.79-4 4-4s4 1.79 4 4c0 1.53-.83 2.93-2.26 3.81L12 16.54z"/>
        </svg>
        <span class="text-sm text-gray-600" x-show="!fileName">Arrastra y suelta una imagen, o</span>
        <span class="text-indigo-600 hover:underline" x-show="!fileName">Selecciona un archivo</span>
        <span class="text-sm text-gray-800" x-show="fileName" x-text="fileName"></span>
    </div>
</div>
