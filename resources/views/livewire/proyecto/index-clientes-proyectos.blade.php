<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Fintech ✨</h1>
            </div>

            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Agregar nuevo proyecto</span>
                </button>

            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <div
                class="flex flex-col col-span-full bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 py-6">

                    <div class="md:flex md:justify-between md:items-center">
                        <div class="flex items-center mb-4 md:mb-0">
                            <div>
                                <div class="mb-2">Hey <strong
                                        class="font-medium text-slate-800 dark:text-slate-100">Mary</strong> 👋, this is
                                    your current balance:</div>
                                <div class="text-3xl font-bold text-emerald-500">70 %</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <div
                class="flex flex-col col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Tareas asignadas al proyecto:</h2>
                </header>
                <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 p-4"
                    draggable="true">


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
                            {{-- @foreach ($clientes as $cliente) --}}
                            <tr>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="text-xs">
                                        <div class="sm:flex sm:justify-between sm:items-start">
                                            <div class="grow mt-0.5 mb-3 sm:mb-0 space-y-3">
                                                <div class="flex items-center">
                                                    <label class="flex items-center">
                                                        <input type="checkbox"
                                                            class="form-checkbox w-5 h-5 rounded-full peer" />
                                                        <span
                                                            class="font-medium text-slate-800 dark:text-slate-100 peer-checked:line-through ml-2">Senior
                                                            Software Engineer Backend</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="text-xs"> greqingrieqngiornqeignreiqung </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <button class="text-yellow-500 focus:outline-none" {{-- wire:click="abrirModalEdicion({{ $cliente->id }})" --}}
                                        title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                            </path>
                                        </svg>
                                    </button>
                                    <button {{-- wire:click.prevent="deleteConfirmation({{ $cliente }})" --}} class="text-red-600 focus:outline-none"
                                        title="Eliminar">
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
                        {{-- @endforeach --}}
                    </table>
                </div>
            </div>

            <div class="flex flex-col col-span-full xl:col-span-4 bg-gradient-to-b bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 shadow-lg rounded-sm border ">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700  flex items-center">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Equipo:</h2>
                </header>
                <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 h-full flex flex-col px-5 py-6">
                    <!-- CC container -->
                    <div class="relative w-full max-w-sm mx-auto p-3 rounded-2xl">
                        <!-- Credit Card -->
                        <div class="relative p-5 rounded-xl overflow-hidden">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
