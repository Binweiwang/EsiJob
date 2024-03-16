<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @include('components.search')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8" style="max-width: 896px">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach($jobs as $job)
                        <li class="border-b border-gray-400">
                            <div class="flex justify-between gap-x-6 py-5 ">
                                <!-- Job Details -->
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $job->title }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $job->description
                                            }}</p>
                                    </div>
                                </div>
                                <!-- Publication Date and Expand Button -->
                                <div class="flex justify-between items-center">
                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        <time datetime="{{$job->publication_date}}">
                                            {{
                                            Carbon\Carbon::parse($job->publication_date)->locale('es')->diffForHumans()
                                            }}
                                        </time>
                                    </p>
                                    <button type="button" class="flex items-center ml-3 expand-button"
                                            data-target="job-details-{{ $job->id }}" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                    </button>
                                </div>

                            </div>
                            <div class="hidden job-details p-4 mt-2 bg-gray-50 border-t border-gray-200"
                                 id="job-details-{{ $job->id }}"
                                 style="display: none">
                                <div>
                                    <p class="text-sm text-gray-700">Requisitos: <span class="text-gray-600">{{ $job->requirements }}</span>
                                    </p>
                                    <p class="mt-2 text-sm text-gray-700">Salario: <span class="text-gray-600">{{ $job->salary }}</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="flex items-center justify-between bg-white px-4 mt-3  sm:px-6">
                        <div class="flex justify-center items-center w-full">
                            <nav class="isolate inline-flex -space-x-px  rounded-md shadow-sm" aria-label="Pagination">
                                <a href="{{$jobs->previousPageUrl()}}"
                                   class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                @for($i = 1; $i <= $jobs->lastPage(); $i++)
                                <a href="{{$jobs->url($i)}}"
                                   class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50 ring-1 ring-inset ring-gray-300">
                                    {{ $i }}
                                </a>
                                @endfor
                                <a href="{{$jobs->nextPageUrl()}}"
                                   class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
<style>
    body::-webkit-scrollbar {
        width: 0.5em;
    }

    .job-details {
        display: none;
        transition: display 0.3s ease-out;
    }

    .rotate_open {
        transform: rotate(90deg);
        transition: transform 0.3s ease;
    }

    .rotate_close {
        transform: rotate(0deg);
        transition: transform 0.3s ease;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const expandButtons = document.querySelectorAll('.expand-button');
        expandButtons.forEach(button => {
            button.addEventListener('click', function () {
                const target = document.getElementById(this.dataset.target);
                if (target.style.display === "none") {
                    target.style.display = "block";
                    this.classList.add('rotate_open');
                    this.classList.remove('rotate_close');
                } else {
                    target.style.display = "none";
                    this.classList.remove('rotate_open');
                    this.classList.add('rotate_close');
                }
            });
        });
    });
</script>
