<div>
    <div>
        @if ($proyectos->isEmpty())
            <div>
                <div class="relative w-full max-w-sm mx-auto p-3 rounded-2xl">
                    <div class="relative p-5 rounded-xl overflow-hidden">
                        <div
                            class="px-4 py-2 rounded-sm text-sm border bg-amber-100 dark:bg-amber-400/30 border-amber-200 dark:border-transparent text-amber-600 dark:text-amber-400">
                            <div class="flex w-full justify-between items-start">
                                <div class="flex">
                                    <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                                    </svg>
                                    <div class="text-lg">El cliente no tiene proyectos asignados todavía.</div>
                                </div>
                            </div>
                            <div class="text-right mt-1 text-base">
                                <a href="{{ route('productos') }}" class="font-medium text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400" href="#0">Ir a proyectos -&gt;</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                <div class="sm:flex sm:justify-between sm:items-center mb-5">

                    <div>
                        <div class="mt-2">
                            <ul class="flex flex-wrap -m-1">
                                @foreach ($proyectos as $proyecto)
                                    <li class="m-1">
                                        <button wire:click="seleccionarProyecto({{ $proyecto->id }})"
                                            class="inline-flex items-center justify-center text-lg font-medium leading-5 rounded-full px-3 py-1
                                               border {{ $proyectoSeleccionado && $proyectoSeleccionado->id == $proyecto->id ? 'bg-indigo-700' : 'bg-indigo-400' }}
                                               border-transparent shadow-sm text-white duration-150 ease-in-out">
                                            {{ $proyecto->nombre }} ✨
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @if ($proyectoSeleccionado)

                    <div class="grid grid-cols-12 gap-6">
                        <div
                            class="flex flex-col col-span-full bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                            <div class="px-5 py-6">
                                <div class="flex items-center justify-between mb-4 md:mb-0">
                                    <div>
                                        <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">
                                            Cliente: {{ $cliente->apellidos }} {{ $cliente->nombres }}
                                        </h1>
                                        <div class="text-xl"></strong>Resumen del proyecto:</div>
                                        <div class="text-2xl font-bold text-emerald-500">
                                            Porcentaje de tareas finalizadas:
                                            {{ $this->calcularPorcentajeTareasFinalizadas($proyectoSeleccionado->id) }}
                                            %
                                        </div>
                                    </div>
                                    @if ($this->todasTareasCompletadasHabilitarFactura($proyectoSeleccionado->id))
                                        <div class="pb-16">
                                            <button class="btn bg-green-500 hover:bg-green-600 text-white"
                                                wire:click="generarFactura({{ $proyectoSeleccionado->id }})">
                                                <svg class="w-4 h-4 shrink-0 fill-current mr-2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15 4c.6 0 1 .4 1 1v10c0 .6-.4 1-1 1H3c-1.7 0-3-1.3-3-3V3c0-1.7 1.3-3 3-3h7c.6 0 1 .4 1 1v3h4zM2 3v1h7V2H3c-.6 0-1 .4-1 1zm12 11V6H2v7c0 .6.4 1 1 1h11zm-3-5h2v2h-2V9z" />
                                                </svg>
                                                <span class="hidden xs:block ml-2">Generar factura</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                            <header
                                class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-100">Planificación:</h2>
                                <div x-data="{ modalOpen: false }">

                                    <button class="btn bg-indigo-400 hover:bg-indigo-600 text-white"
                                        @click.prevent="modalOpen = true" aria-controls="feedback-modal">
                                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                            <path
                                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                        </svg>
                                        <span class="hidden xs:block ml-2">Agregar nueva tarea</span>
                                    </button>
                                    <!-- Modal backdrop -->
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
                                                    <div class="font-semibold text-slate-800 dark:text-slate-100">Nueva
                                                        Tarea
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
                                                <div class="space-y-3 grid grid-cols-6 md:grid-cols-6">
                                                    <div class="col-span-3 col-start-1">
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
                                                            for="fecha_limite">Fecha
                                                            Límite</label>
                                                        <input id="fecha_limite" class="form-input w-full px-2 py-1"
                                                            type="date" wire:model="fecha_limite" required />
                                                    </div>
                                                    <div class="col-span-6 col-start-1">
                                                        <label class="blocl text-sm font-medium mb-1"
                                                            for="descripcion">Descripción</label>
                                                        <input id="descripcion" class="form-input w-full px-2 py-1"
                                                            type="text" wire:model="descripcion" required />
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="px-5 py-4 border-t border-slate-200 dark:border-slate-700">
                                                <div class="flex flex-wrap justify-between items-center">
                                                    <div class="text-sm text-red-500 pb-2">
                                                        Los campos con * son obligatorios
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button
                                                            class="btn-sm bg-red-500 dark:bg-red-500 hover:bg-red-600 dark:hover:bg-red-600 text-white dark:text-white border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600"
                                                            @click="modalOpen = false">Cancel</button>
                                                        <button
                                                            class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white"
                                                            wire:click="crearTarea"
                                                            x-on:click="if (!@this.creatingCliente) modalOpen = false">Crear
                                                            Tarea</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <div
                                class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 p-4 overflow-x-auto">
                                @if ($tareas->count() > 0)
                                    <table class="table-auto w-full dark:text-slate-300">
                                        <!-- Table header -->
                                        <thead
                                            class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-900/20 border-t border-b border-slate-200 dark:border-slate-700">
                                            <tr>
                                                <th class="px-5 py-3 text-xs text-left">
                                                    <span class="font-semibold">Nombre</span>
                                                </th>
                                                <th class="px-3 py-3 text-xs text-left">
                                                    <span class="font-semibold">Descripcion</span>
                                                </th>
                                                <th class="px-2 py-3 text-xs text-left">
                                                    <span class="font-semibold">Acciones</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-xs divide-y divide-slate-200 dark:divide-slate-700">

                                            @foreach ($tareas as $tarea)
                                                <tr>
                                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                        <label class="flex items-center">
                                                            <input type="checkbox"
                                                                class="form-checkbox w-5 h-5 rounded-full peer"
                                                                wire:click="toggleCompletada({{ $tarea->id }})"
                                                                {{ $tarea->completada ? 'checked' : '' }} />
                                                            <span
                                                                class="font-medium text-slate-800 dark:text-slate-100 peer-checked:line-through ml-2">{{ $tarea->nombre }}</span>
                                                        </label>
                                                    </td>
                                                    <td class="px-2 first:pl-5 last:pr-5 py-3">
                                                        <div class="text-xs"> {{ $tarea->descripcion ?? '' }}</div>
                                                    </td>
                                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                        <button class="text-yellow-500 focus:outline-none"
                                                            wire:click="abrirModalEdicion({{ $tarea->id }})"
                                                            title="Editar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" class="w-7 h-7">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                        <button
                                                            wire:click.prevent="deleteConfirmation({{ $tarea }})"
                                                            class="text-red-600 focus:outline-none" title="Eliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" class="w-7 h-7">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                @else
                                    <div
                                        class="px-4 py-7 rounded-sm text-sm border bg-amber-100 dark:bg-amber-400/30 border-amber-200 dark:border-transparent text-amber-600 dark:text-amber-400">
                                        <div class="flex w-full justify-between items-start">
                                            <div class="flex">
                                                <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                                                </svg>
                                                <div class="text-lg">No hay tareas asociadas a este proyecto.</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div
                            class="flex flex-col col-span-full xl:col-span-4 bg-gradient-to-b bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 shadow-lg rounded-sm border ">
                            <header
                                class="px-5 py-4 border-b border-slate-100 dark:border-slate-700  flex items-center">
                                <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-100">Equipo:</h2>
                            </header>
                            <div
                                class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 h-full flex flex-col px-5 py-6">
                                <div class="relative w-full max-w-sm mx-auto p-3 rounded-2xl">
                                    <div class="relative p-5 rounded-xl overflow-hidden">
                                        <div
                                            class="px-4 py-7 rounded-sm text-sm border bg-amber-100 dark:bg-amber-400/30 border-amber-200 dark:border-transparent text-amber-600 dark:text-amber-400">
                                            <div class="flex w-full justify-between items-start">
                                                <div class="flex">
                                                    <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                                                    </svg>
                                                    <div class="text-lg">Próximamente.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        @endif

        <div x-data="{ modalOpen: @entangle('editModalOpen') }">
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
                            <div class="font-semibold text-slate-800 dark:text-slate-100">Actualizar Tarea
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
                        <div class="space-y-3 grid grid-cols-4 md:grid-cols-6">
                            <div class="col-span-3 col-start-1">
                                <label class="block text-sm font-medium mb-1" for="nombres">Nombre<span
                                        class="text-rose-500">*</span></label>
                                <input id="editnombre" class="form-input w-full px-2 py-1" type="text"
                                    wire:model="editnombre" required />
                                @error('editnombre')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-3 col-start-1">
                                <label class="block text-sm font-medium mb-1" for="email">Fecha Límite</label>
                                <input id="editfechalimite" class="form-input w-full px-2 py-1" type="date"
                                    wire:model="editfechalimite" />
                            </div>
                            <div class="col-span-6 col-start-1">
                                <label class="block text-sm font-medium mb-1" for="apellidos">Descripción</label>
                                <input id="editdescripcion" class="form-input w-full px-2 py-1" type="text"
                                    wire:model="editdescripcion" />
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="px-5 py-4 border-t border-slate-200 dark:border-slate-700">
                        <div class="flex flex-wrap justify-between items-center">
                            <div class="text-sm text-red-500 pb-2">
                                Los campos con * son obligatorios
                            </div>
                            <div class="flex space-x-2">
                                <button
                                    class="btn-sm bg-red-500 dark:bg-red-500 hover:bg-red-600 dark:hover:bg-red-600 text-white dark:text-white border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600"
                                    @click="modalOpen = false">Cancel</button>
                                <form wire:submit.prevent="actualizarTarea">
                                    <!-- Campos de edición aquí -->
                                    <button type="submit" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white"
                                        @click="actualizarTarea">Actualizar Tarea</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('generarFacturaPDF', proyectoId => {
                window.open(`/generar-factura/${proyectoId}`, '_blank');
            });
        });
    </script>
</div>
