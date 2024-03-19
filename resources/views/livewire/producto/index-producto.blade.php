<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <x-dashboard.welcome-banner />

        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div>
                <div class="m-1.5">
                    <div x-data="{ modalOpen: false }">

                        <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true"
                            aria-controls="feedback-modal">
                            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                            <span class="hidden xs:block ml-2">Nuevo Producto</span>
                        </button>

                        <!-- Modal backdrop -->
                        <div class="fixed inset-0 bg-slate-900 bg-opacity-70 z-50 transition-opacity" x-show="modalOpen"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true"
                            x-cloak></div>
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
                                        <div class="font-semibold text-slate-800 dark:text-slate-100">Nuevo Cliente
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
                                            <label class="block text-sm font-medium mb-1" for="codigo">Código<span
                                                    class="text-rose-500">*</span></label>
                                            <input id="codigo" class="form-input w-full px-2 py-1" type="text"
                                                wire:model="codigo" required />
                                            @error('codigo')
                                                <small class="text-red-600">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-span-3 col-start-1">
                                            <label class="block text-sm font-medium mb-1" for="descripcion">Descripción<span
                                                    class="text-rose-500">*</span></label>
                                            <input id="descripcion" class="form-input w-full px-2 py-1" type="text"
                                                wire:model="descripcion" required />
                                            @error('descripcion')
                                                <small class="text-red-600">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-span-3">
                                            <label class="block text-sm font-medium mb-1" for="imagen">Imagen</label>
                                            <input id="imagen" class="form-input w-full px-2 py-1" type="text"
                                                wire:model="imagen" required />
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
                                            <button class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white"
                                                wire:click="crearProducto"
                                                x-on:click="if (!@this.creatingProducto) modalOpen = false">Crear
                                                Producto</button>
                                            <button
                                                class="btn-sm bg-red-500 dark:bg-red-500 hover:bg-red-600 dark:hover:bg-red-600 text-white dark:text-white border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600"
                                                @click="modalOpen = false">Cancel</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="sm:flex justify-between sm:justify-between px-5 py-4">
                <div class="relative flex-grow flex items-center">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="search" wire:model.debounce.700ms="search"
                        class="block p-2 pl-10 text-sm text-gray-900 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 border-gray-300 dark:placeholder-white dark:bg-slate-900/20
                                md:w-72 sm:w-72 xs:w-24 dark:text-white"
                        placeholder="Buscar por nombre o apellido..." required xss-protection>
                </div>
                <header class="py-4">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Todos los productos: <span
                            class="text-slate-400 dark:text-slate-500 font-medium">{{ $productosCount }}</span></h2>
                </header>
            </div>

            <div>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full dark:text-slate-300">
                        <!-- Table header -->
                        <thead
                            class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-900/20 border-t border-b border-slate-200 dark:border-slate-700">
                            <tr>
                                <th class="px-5 py-3 text-xs text-left">
                                    <span class="font-semibold">Código</span>
                                </th>
                                <th class="px-3 py-3 text-xs text-left">
                                    <span class="font-semibold">Descripción</span>
                                </th>
                                <th class="px-2 py-3 text-xs text-left">
                                    <span class="font-semibold">Imagen</span>
                                </th>
                                <th class="px-2 py-3 text-xs text-left">
                                    <span class="font-semibold">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="text-xs"> {{ $producto->codigo }} </div>
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="text-xs"> {{ $producto->descripcion }} </div>
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="text-xs"> {{ $producto->imagen }} </div>
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <button class="text-yellow-500 focus:outline-none"
                                            wire:click="abrirModalEdicion({{ $producto->id }})" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-7 h-7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                                </path>
                                            </svg>
                                        </button>
                                       {{--  <button wire:click.prevent="deleteConfirmation({{ $cliente }})"
                                            class="text-red-600 focus:outline-none" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-7 h-7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                </path>
                                            </svg>
                                        </button> --}}
                                    </td>
                                </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-8">
            {{ $productos->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirModalEdicion', () => {
                Livewire.emit('clienteModalOpen', true);
            });

            Livewire.on('cerrarModalEdicion', () => {
                Livewire.emit('clienteModalOpen', false);
            });
        });
    </script>
</div>
