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
                <svg class="w-12 h-12 text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 14l2-2 4 4m0 0l-4 4m4-4H5"></path>
                </svg>
                <p class="text-gray-500 text-lg">No se encontraron trabajos</p>
            </div>
        </li>
        @endif
        @foreach($jobs as $job)
        <li class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-x-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-500 text-white">
                        @if($job->company_logo == null)
                        <i class="fas fa-briefcase"></i>
                        @else
                        <img src="{{ asset('storage/' . $job->company_logo) }}" alt="Logo de la empresa"
                             class="w-12 h-12 rounded-full object-cover">
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <div class="text-lg font-semibold text-gray-900 job-title cursor-pointer hover:underline"
                             data-target="job-details-{{ $job->id }}" aria-expanded="false">
                            {{ $job->title }}
                        </div>
                        <p class="text-xs text-gray-500">
                            <time datetime="{{$job->publication_date}}">
                                {{ Carbon\Carbon::parse($job->publication_date)->locale('es')->diffForHumans() }}
                            </time>
                        </p>
                    </div>
                </div>
                <button type="button" class="flex items-center expand-button focus:outline-none"
                        data-target="job-details-{{ $job->id }}" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6 text-gray-600 transition-transform transform duration-300"
                         :class="{'rotate-180': isExpanded}">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                    </svg>
                </button>
            </div>
            <div
                class="hidden job-details p-4 mt-4 bg-gray-50 border-t border-gray-300 rounded-lg transition duration-300 ease-in-out"
                id="job-details-{{ $job->id }}">
                @if(Auth::check() && Auth::user()->email_verified_at !== null)
                <div x-data="{blur: true}"
                     :class="{'blur-sm': blur}"
                     @click="blur = false"
                     class="hover:cursor-pointer p-6 bg-white shadow-lg rounded-lg transition-transform duration-300 transform hover:scale-105 hover:shadow-2xl">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Columna izquierda: Descripción -->
                        <div class="space-y-4">
                            <p class="text-base text-gray-800 leading-relaxed">{{ $job->description }}</p>
                        </div>

                        <!-- Columna derecha: Detalles -->
                        <div class="space-y-4">
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-900 inline">Requisitos: </p>
                                <span class="font-medium">{{ $job->requirements }}</span>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-900 inline">Salario: </p>
                                <span class="font-medium">{{ $job->salary }}</span>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-900 inline">Ubicación: </p>
                                <span class="font-medium">{{ $job->location }}</span>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-900 inline">Empresa: </p>
                                <span class="font-medium">{{ $job->user->name_company }}</span>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-900 inline">Tiempo: </p>
                                <span class="font-medium">{{ $job->workday }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </li>
        @endforeach
    </ul>
    <div class="mt-4 text-right">
        <span class="text-sm text-gray-700">Créditos restantes: <span id="credit-count">{{ $credits }}</span></span>
    </div>
</div>
<div id="credit-alert-modal"
     class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Alerta</h2>
            <button id="close-modal-button" class="text-gray-700 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <p class="text-gray-700 mb-4">No tienes suficientes créditos para ver más detalles.</p>
        <div class="text-right">
            <button id="modal-ok-button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">OK
            </button>
        </div>
    </div>
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
        const modal = document.getElementById('credit-alert-modal');
        const closeModalButton = document.getElementById('close-modal-button');
        const modalOkButton = document.getElementById('modal-ok-button');

        expandableElements.forEach(element => {
            element.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const target = document.getElementById(targetId);
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                const button = this.closest('li').querySelector('.expand-button svg');

                if (!isExpanded) {
                    const creditsCountElement = document.getElementById('credit-count');
                    let currentCredits = parseInt(creditsCountElement.innerText);

                    // Mostrar mensaje y actualizar créditos antes de la petición
                    if (currentCredits > 0) {
                        currentCredits -= 1;
                        creditsCountElement.innerText = currentCredits;
                        fetch('/reduce-credits', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({job_id: targetId.split('-')[2]})
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (!data.success) {
                                    alert(data.message);
                                    // Revertir la reducción de créditos en caso de error
                                    currentCredits += 1;
                                    creditsCountElement.innerText = currentCredits;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Ha ocurrido un error. Por favor, inténtalo de nuevo.');
                                // Revertir la reducción de créditos en caso de error
                                currentCredits += 1;
                                creditsCountElement.innerText = currentCredits;
                            });
                        this.setAttribute('aria-expanded', 'true');
                        target.classList.remove('hidden');
                        target.classList.add('fade-down-enter');
                        target.classList.remove('fade-down-leave');
                        button.classList.add('rotate-open');
                        button.classList.remove('rotate-close');
                    } else {
                        modal.classList.remove('hidden');
                        // quiero dehsabilitar el scroll
                        document.body.style.overflow = 'hidden';
                    }
                } else {
                    this.setAttribute('aria-expanded', 'false');
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

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
            // quiero habilitar el scroll
            document.body.style.overflow = 'auto';
        });

        modalOkButton.addEventListener('click', () => {
            modal.classList.add('hidden');
            // quiero habilitar el scroll
            document.body.style.overflow = 'auto';
        });
    });
</script>
