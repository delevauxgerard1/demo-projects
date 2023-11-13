<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <div class="relative bg-indigo-200 dark:bg-indigo-500 p-4 sm:p-6 rounded-sm overflow-hidden mb-8">

            <!-- Background illustration -->
            <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
                <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                        <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                        <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                        <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                            <stop stop-color="#A5B4FC" offset="0%" />
                            <stop stop-color="#818CF8" offset="100%" />
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#4338CA" offset="0%" />
                            <stop stop-color="#6366F1" stop-opacity="0" offset="100%" />
                        </linearGradient>
                    </defs>
                    <g fill="none" fill-rule="evenodd">
                        <g transform="rotate(64 36.592 105.604)">
                            <mask id="welcome-d" fill="#fff">
                                <use xlink:href="#welcome-a" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                        </g>
                        <g transform="rotate(-51 91.324 -105.372)">
                            <mask id="welcome-f" fill="#fff">
                                <use xlink:href="#welcome-e" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                        <g transform="rotate(44 61.546 392.623)">
                            <mask id="welcome-h" fill="#fff">
                                <use xlink:href="#welcome-g" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                    </g>
                </svg>
            </div>

            <!-- Content -->
            <div class="relative">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold mb-1">Bienvenido,
                    {{ Auth::user()->name }} 👋</h1>
                <p class="dark:text-indigo-200">Este es el estado de los proyectos hoy:</p>
            </div>

        </div>

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div>
                <div class="m-1.5">
                    <div x-data="{ modalOpen: false }">


                        <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true"
                            aria-controls="feedback-modal" title="Nuevo Proyecto">
                            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                            <span class="hidden xs:block ml-2">Nuevo Proyecto</span>
                        </button>
                        <div class="fixed inset-0 bg-slate-900 bg-opacity-70 z-50 transition-opacity"
                            x-show="modalOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-out duration-100"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            aria-hidden="true" x-cloak></div>
                        <!-- Modal dialog -->
                        <div id="feedback-modal"
                            class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
                            role="dialog" aria-modal="true" x-show="modalOpen"
                            x-transition:enter="transition ease-in-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in-out duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
                            <div class="bg-white dark:bg-slate-800 rounded shadow-lg overflow-auto max-w-lg w-full max-h-full"
                                @keydown.escape.window="modalOpen = false">
                                <!-- Modal header -->
                                <div class="px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                                    <div class="flex justify-between items-center">
                                        <div class="font-semibold text-slate-800 dark:text-slate-100">
                                            Nuevo Proyecto
                                        </div>
                                        <button
                                            class="text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400"
                                            @click="modalOpen = false">
                                            <div class="sr-only">Close</div>
                                            <svg class="w-4 h-4 fill-current">
                                                <path
                                                    d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- Modal content -->
                                <div class="px-5 py-4">
                                    <div class="space-y-3 grid grid-cols-4 md:grid-cols-6 gap-4">
                                        <div class="col-span-5 col-start-1">
                                            <label class="block text-sm font-medium mb-1"
                                                for="nombre">Nombre<span
                                                    class="text-rose-500">*</span></label>
                                            <input id="nombre" class="form-input w-full px-2 py-1"
                                                type="text" wire:model="nombre" required />
                                            @error('nombre')
                                                <small class="text-red-600">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-span-3 col-start-1">
                                            <label class="block text-sm font-medium mb-1"
                                                for="descripcion">Descripción</label>
                                            <input id="descripcion"
                                                class="form-input w-full px-2 py-1" type="text"
                                                wire:model="descripcion" />
                                        </div>
                                        <div class="col-span-3">
                                            <label class="block text-sm font-medium mb-1"
                                                for="cliente_id">Cliente<span
                                                    class="text-rose-500">*</span></label>
                                            <select
                                                class="w-full text-sm transition-all duration-100  rounded-lg shadow-sm outline-none focus:border-primary focus:ring-primary placeholder:text-gray-400 dark:bg-gray-700 disabled:opacity-70 dark:focus:border-primary"
                                                placeholder="Cliente" id="cliente_id"
                                                name="cliente_id" wire:model.defer="cliente_id">
                                                <option hidden selected>Seleccione un cliente</option>
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}">
                                                        {{ $cliente->apellidos }}
                                                        {{ $cliente->nombres }}</option>
                                                @endforeach
                                            </select>
                                            @error('cliente_id')
                                                <small class="text-red-600">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-span-3">
                                            <label class="block text-sm font-medium mb-1"
                                                for="fecha_fin">Fecha Fin</label>
                                            <input id="fecha_fin" class="form-input w-full px-2 py-1"
                                                type="date" wire:model="fecha_fin" required />
                                        </div>
                                        <div class="col-span-3">
                                            <label class="block text-sm font-medium mb-1"
                                                for="responsable_id">Responsable</label>
                                            <select
                                                class="w-full text-sm transition-all duration-100  rounded-lg shadow-sm outline-none focus:border-primary focus:ring-primary placeholder:text-gray-400 dark:bg-gray-700 disabled:opacity-70 dark:focus:border-primary"
                                                placeholder="Cliente" id="responsable_id"
                                                name="responsable_id"
                                                wire:model.defer="responsable_id">
                                                <option value="">Seleccione un responsable</option>
                                                @foreach ($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}">
                                                        {{ $usuario->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="px-5 py-4 border-t border-slate-200 dark:border-slate-700">
                                    <div class="flex flex-wrap justify-end space-x-2">
                                        <button
                                            class="btn-sm bg-red-500 dark:bg-red-500 hover:bg-red-600 dark:hover:bg-red-600 text-white dark:text-white border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600"
                                            @click="modalOpen = false">Cancel</button>
                                        <button
                                            class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white"
                                            wire:click="crearProyecto"
                                            x-on:click="if (!@this.creatingProyecto) modalOpen = false">Crear
                                            Proyecto</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                </div>
            </div>
            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                {{-- <x-dropdown-filter align="right" /> --}}

                <!-- Datepicker built with flatpickr -->
                {{-- <x-datepicker /> --}}
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Todos los proyectos: <span
                        class="text-slate-400 dark:text-slate-500 font-medium">{{ $proyectosCount }}</span></h2>
            </header>

            <div>

                <!-- Table -->
                <table class="table-auto w-full dark:text-slate-300">
                    <!-- Table header -->
                    <thead
                        class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-900/20 border-t border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-5 py-3 text-xs text-left">
                                <span class="font-semibold">Cliente</span>
                            </th>
                            <th class="px-3 py-3 text-xs text-left">
                                <span class="font-semibold">Nombre Proyecto</span>
                            </th>
                            <th class="px-2 py-3 text-xs text-left">
                                <span class="font-semibold">Fecha Inicio</span>
                            </th>
                            <th class="px-2 py-3 text-xs text-left">
                                <span class="font-semibold">Estado</span>
                            </th>
                            <th class="px-2 py-3 text-xs text-left">
                                <span class="font-semibold">Responsable</span>
                            </th>
                            <th class="px-2 py-3 text-xs text-left">
                                <span class="font-semibold">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach ($proyectos as $proyecto)
                            <tr>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="text-xs"> {{ $proyecto->cliente->apellidos ?? '' }}
                                        {{ $proyecto->cliente->nombres ?? '' }} </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="text-xs"> {{ $proyecto->nombre ?? '' }} </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="text-xs"> {{ $proyecto->fecha_inicio ?? '' }} </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="text-xs"> {{ $proyecto->estado->nombre ?? '' }} </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="text-left text-xs {{-- font-medium dark:text-sky-400 --}}">
                                        {{ $proyecto->usuario->name ?? '' }}
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <button class="focus:outline-none pr-1"
                                        wire:click="clientesProyectos({{ $proyecto->id }})" title="Proyectos">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" stroke-width="2"
                                            class="w-7 h-6">
                                            <path
                                                d="M0 96C0 60.7 28.7 32 64 32H196.1c19.1 0 37.4 7.6 50.9 21.1L289.9 96H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16H286.6c-10.6 0-20.8-4.2-28.3-11.7L213.1 87c-4.5-4.5-10.6-7-17-7H64z"
                                                fill="green" />
                                        </svg>
                                    </button>
                                    <button class="text-yellow-500 focus:outline-none"
                                        wire:click="abrirModalEdicion({{ $proyecto->id }})" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click.prevent="deleteConfirmation({{ $proyecto }})"
                                        class="text-red-600 focus:outline-none" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                    </tbody>
                    @endforeach
                </table>


            </div>
        </div>
        <div class="mt-8">
            {{ $proyectos->links() }}
        </div>
    </div>

    <div x-data="{ modalOpen: @entangle('proyectoModalOpen') }">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-70 z-50 transition-opacity" x-show="modalOpen"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak>
        </div>

        <div id="feedback-modal"
            class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
            role="dialog" aria-modal="true" x-show="modalOpen"
            x-transition:enter="transition ease-in-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in-out duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
            x-cloak>
            <div class="bg-white dark:bg-slate-800 rounded shadow-lg overflow-auto max-w-lg w-full max-h-full"
                @keydown.escape.window="modalOpen = false">
                <!-- Modal header -->
                <div class="px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-slate-800 dark:text-slate-100">Actualizar Proyecto
                        </div>
                        <button
                            class="text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400"
                            @click="modalOpen = false">
                            <div class="sr-only">Close</div>
                            <svg class="w-4 h-4 fill-current">
                                <path
                                    d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Modal content -->
                <div class="px-5 py-4">
                    <div class="space-y-3 grid grid-cols-4 md:grid-cols-6 gap-4">
                        <div class="col-span-5 col-start-1">
                            <label class="block text-sm font-medium mb-1" for="nombres">Nombre<span
                                    class="text-rose-500">*</span></label>
                            <input id="editnombre" class="form-input w-full px-2 py-1" type="text"
                                wire:model="editnombre" required />
                            @error('editnombre')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-3 col-start-1">
                            <label class="block text-sm font-medium mb-1" for="apellidos">Descripción</label>
                            <input id="editdescripcion" class="form-input w-full px-2 py-1" type="text"
                                wire:model="editdescripcion" />
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium mb-1" for="email">Cliente<span
                                    class="text-rose-500">*</span></label>
                            <select id="editcliente_id" name="editcliente_id" wire:model.defer="editcliente_id"
                                class="rounded-lg border border-solid border-gray-300 flex-1 appearance-none w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Seleccione una opción</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->apellidos }}
                                        {{ $cliente->nombres }}</option>
                                @endforeach
                            </select>
                            @error('editcliente_id')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium mb-1" for="editfecha_inicio">Fecha Inicio</label>
                            <input id="editfecha_inicio" class="form-input w-full px-2 py-1" type="date"
                                wire:model="editfecha_inicio" />
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium mb-1" for="editfecha_fin">Fecha Fin</label>
                            <input id="editfecha_fin" class="form-input w-full px-2 py-1" type="date"
                                wire:model="editfecha_fin" />
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium mb-1" for="editestado_id">Estado</label>
                            <select id="editestado_id" name="editestado_id" wire:model.defer="editestado_id"
                                class="rounded-lg border border-solid border-gray-300 flex-1 appearance-none w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium mb-1" for="editresponsable_id">Responsable</label>
                            <select id="editresponsable_id" name="editresponsable_id"
                                wire:model.defer="editresponsable_id"
                                class="rounded-lg border border-solid border-gray-300 flex-1 appearance-none w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Seleccione una opción</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="px-5 py-4 border-t border-slate-200 dark:border-slate-700">
                    <div class="flex flex-wrap justify-end space-x-2">
                        <button
                            class="btn-sm bg-red-500 dark:bg-red-500 hover:bg-red-600 dark:hover:bg-red-600 text-white dark:text-white border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600"
                            @click="modalOpen = false">Cancel</button>
                        <form wire:submit.prevent="actualizarProyecto">
                            <!-- Campos de edición aquí -->
                            <button type="submit" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white"
                                @click="actualizarProyecto">Actualizar Proyecto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirModalEdicion', () => {
                Livewire.emit('proyectoModalOpen', true);
            });

            Livewire.on('cerrarModalEdicion', () => {
                Livewire.emit('proyectoModalOpen', false);
            });
        });
    </script>
</div>
