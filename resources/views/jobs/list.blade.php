<div class="bg-blue-50 rounded-lg p-5 shadow-md">
    <div class="flex justify-between items-center bg-gray-700 shadow-md py-4 font-semibold rounded-t-lg">
        <div class="px-4">
            <p class="text-white font-bold">Titulo</p>
        </div>
        <div class="px-4">
            <p class="text-white font-bold">Fecha de publicación</p>
        </div>
    </div>
    <ul role="list" class="divide-y divide-gray-400 bg-white rounded-b-lg">
        @if($jobs->isEmpty())
            <li class="px-4 py-6 text-center animate-pulse">
                <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2-2 4 4m0 0l-4 4m4-4H5"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">No se encontraron trabajos</p>
                </div>
            </li>
        @endif
        @foreach($jobs as $job)
        <li class="px-4 py-4">
            <div class="flex justify-between gap-x-6">
                <!-- Job Details -->
                <div class="flex min-w-0 gap-x-4 items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-[15px] bg-blue-500 text-white">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="min-w-0 flex-auto">
                        <div class="text-sm font-semibold leading-6 text-gray-900 job-title cursor-pointer"
                             data-target="job-details-{{ $job->id }}" aria-expanded="false">
                            {{ $job->title }}
                        </div>
                    </div>
                </div>
                <!-- Publication Date and Expand Button -->
                <div class="flex items-center">
                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        <time datetime="{{$job->publication_date}}">
                            {{ Carbon\Carbon::parse($job->publication_date)->locale('es')->diffForHumans() }}
                        </time>
                    </p>
                    <button type="button" class="flex items-center ml-3 expand-button"
                            data-target="job-details-{{ $job->id }}" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="hidden job-details p-4 mt-2 bg-gray-50 border-t border-gray-300 rounded-lg"
                 id="job-details-{{ $job->id }}">
                <div>
                    <p class="mt-1 text-sm leading-5 text-gray-500">{{ $job->description }}</p>
                    <p class="text-sm text-gray-700 mt-2">Requisitos: <span class="text-gray-600">{{ $job->requirements }}</span></p>
                    <p class="text-sm text-gray-700 mt-2">Salario: <span class="text-gray-600">{{ $job->salary }}</span></p>
                    <p class="text-sm text-gray-700 mt-2">Ubicación: <span class="text-gray-600">{{ $job->location }}</span></p>
                    <p class="text-sm text-gray-700 mt-2">Empresa: <span class="text-gray-600">{{ $job->employer->name_company }}</span></p>
                    <p class="text-sm text-gray-700 mt-2">Tiempo: <span class="text-gray-600">{{ $job->workday }}</span></p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>

<style>
    .job-title {
        cursor: pointer;
    }

    .job-details {
        transition: display 0.3s ease-out;
    }

    @keyframes rotateOpen {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(90deg);
        }
    }

    @keyframes rotateClose {
        from {
            transform: rotate(90deg);
        }
        to {
            transform: rotate(0deg);
        }
    }

    .rotate-open {
        animation: rotateOpen 0.5s ease-out forwards;
    }

    .rotate-close {
        animation: rotateClose 0.5s ease-out forwards;
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    .fade-down-enter {
        animation: fadeDown 0.5s ease-out forwards;
    }

    .fade-down-leave {
        animation: fadeUp 0.5s ease-out forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const expandableElements = document.querySelectorAll('.expand-button, .job-title');

        expandableElements.forEach(element => {
            element.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const target = document.getElementById(targetId);
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                const button = this.closest('li').querySelector('.expand-button svg');

                this.setAttribute('aria-expanded', String(!isExpanded));

                if (!isExpanded) {
                    target.classList.remove('hidden');
                    target.classList.add('fade-down-enter');
                    target.classList.remove('fade-down-leave');
                    button.classList.add('rotate-open');
                    button.classList.remove('rotate-close');
                } else {
                    target.classList.add('fade-down-leave');
                    target.classList.remove('fade-down-enter');
                    button.classList.remove('rotate-open');
                    button.classList.add('rotate-close');

                    target.addEventListener('animationend', () => {
                        if (target.classList.contains('fade-down-leave')) {
                            target.classList.add('hidden');
                        }
                    }, {once: true});
                }
            });
        });
    });
</script>
