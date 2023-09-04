<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div>
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Nuevo Cliente</span>
                </button>
                <h1>Hola</h1>
            </div>
            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <x-dropdown-filter align="right" />

                <!-- Datepicker built with flatpickr -->
                <x-datepicker />
            </div>
        </div>

        <!-- Cards -->
        {{-- <div class="grid grid-cols-12 gap-6">

            <!-- Line chart (Acme Plus) -->
            <x-dashboard.dashboard-card-01 :dataFeed="$dataFeed" />

            <!-- Line chart (Acme Advanced) -->
            <x-dashboard.dashboard-card-02 :dataFeed="$dataFeed" />

            <!-- Line chart (Acme Professional) -->
            <x-dashboard.dashboard-card-03 :dataFeed="$dataFeed" />

            <!-- Bar chart (Direct vs Indirect) -->
            <x-dashboard.dashboard-card-04 />

            <!-- Line chart (Real Time Value) -->
            <x-dashboard.dashboard-card-05 />

            <!-- Doughnut chart (Top Countries) -->
            <x-dashboard.dashboard-card-06 />

            <!-- Table (Top Channels) -->
            <x-dashboard.dashboard-card-07 />

            <!-- Line chart (Sales Over Time)  -->
            <x-dashboard.dashboard-card-08 />

            <!-- Stacked bar chart (Sales VS Refunds) -->
            <x-dashboard.dashboard-card-09 />

            <!-- Card (Customers)  -->
            <x-dashboard.dashboard-card-10 />

            <!-- Card (Reasons for Refunds)   -->
            <x-dashboard.dashboard-card-11 />             

            <!-- Card (Recent Activity) -->
            <x-dashboard.dashboard-card-12 />
            
            <!-- Card (Income/Expenses) -->
            <x-dashboard.dashboard-card-13 />

        </div> --}}
        <div
            class="bg-white dark:bg-slate-800 rounded-sm border border-slate-200 dark:border-slate-700 p-2 overflow-x-auto">
            <header class="text-slate-800 dark:text-slate-100">
                <h2 class="text-2xl font-semibold">Todos los clientes: <span class="text-indigo-600">248</span></h2>
            </header>
            <div x-data="handleSelect">

                <!-- Table -->
                <div class="mt-4">
                    <table class="min-w-full table-auto">
                        <!-- Table header -->
                        <thead class="bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400">
                            <tr>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Nombre</span>
                                </th>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Email</span>
                                </th>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Location</span>
                                </th>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Orders</span>
                                </th>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Last order</span>
                                </th>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Total spent</span>
                                </th>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Refunds</span>
                                </th>
                                <th class="px-5 py-3 text-sm font-normal text-left">
                                    <span class="text-slate-600 dark:text-slate-100">Menu</span>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm text-slate-800 dark:text-slate-100">
                            <!-- Row -->
                            <tr>
                                <td class="px-5 py-2 ">
                                    <div class="flex items-center">
                                        <div class="text-slate-800 dark:text-slate-100">Patricia Semklo</div>
                                    </div>
                                </td>
                                <td class="px-5 py-2">
                                    <div>patricia.semklo@app.com</div>
                                </td>
                                <td class="px-5 py-2">
                                    <div>🇬🇧 London, UK</div>
                                </td>
                                <td class="px-5 py-2">
                                    <div>24</div>
                                </td>
                                <td class="px-5 py-2">
                                    <div>#123567</div>
                                </td>
                                <td class="px-5 py-2">
                                    <div>$2,890.66</div>
                                </td>
                                <td class="px-5 py-2">
                                    <div>-</div>
                                </td>
                                <td class="px-5 py-2">
                                    <button class="text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="text-amber-500 hover:animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button class="text-red-500 hover:animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        {{-- <div
            class="bg-white dark:bg-slate-800 rounded-sm border border-slate-200 dark:border-slate-700 p-2 overflow-x-auto">
            <header class="text-slate-800 dark:text-slate-100">
                <h2 class="text-2xl font-semibold">All Customers <span class="text-indigo-600">248</span></h2>
            </header>
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                User
                            </th>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Role
                            </th>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Created at
                            </th>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="#" class="relative block">
                                            <img alt="profil" src="/images/person/8.jpg"
                                                class="mx-auto object-cover rounded-full h-10 w-10 " />
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            Jean marc
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    Admin
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    12/09/2020
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                    <span aria-hidden="true"
                                        class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                    </span>
                                    <span class="relative">
                                        active
                                    </span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex flex-col items-center px-5 py-5 bg-white xs:flex-row xs:justify-between">
                    <div class="flex items-center">
                        <button type="button"
                            class="w-full p-4 text-base text-gray-600 bg-white border rounded-l-xl hover:bg-gray-100">
                            <svg width="9" fill="currentColor" height="8" class=""
                                viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1427 301l-531 531 531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19l-742-742q-19-19-19-45t19-45l742-742q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z">
                                </path>
                            </svg>
                        </button>
                        <button type="button"
                            class="w-full px-4 py-2 text-base text-indigo-500 bg-white border-t border-b hover:bg-gray-100 ">
                            1
                        </button>
                        <button type="button"
                            class="w-full px-4 py-2 text-base text-gray-600 bg-white border hover:bg-gray-100">
                            2
                        </button>
                        <button type="button"
                            class="w-full px-4 py-2 text-base text-gray-600 bg-white border-t border-b hover:bg-gray-100">
                            3
                        </button>
                        <button type="button"
                            class="w-full px-4 py-2 text-base text-gray-600 bg-white border hover:bg-gray-100">
                            4
                        </button>
                        <button type="button"
                            class="w-full p-4 text-base text-gray-600 bg-white border-t border-b border-r rounded-r-xl hover:bg-gray-100">
                            <svg width="9" fill="currentColor" height="8" class=""
                                viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    </div>


    </div>
</x-app-layout>
