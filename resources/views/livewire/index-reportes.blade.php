<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Analytics ✨</h1>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div
                class="flex flex-col col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Proyectos por estado</h2>
                </header>
                <div class="px-5 py-1">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div
                class="flex flex-col col-span-full xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Porcentaje total de tareas completadas
                    </h2>
                </header>
                <div class="flex flex-col h-full">
                    <canvas id="myChart2" width="100" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: @json($chartData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                plugins: {
                    legend: {
                        display: false
                    },
                },
            },
        });
        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx, {
            type: 'pie',
            data: @json($chartData2),
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.formattedValue;

                                return label + ': ' + value + '%';
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        display: false,
                    },
                },
                elements: {
                    line: {
                        borderWidth: 0,
                    },
                },
            },
        });
    </script>
</div>
