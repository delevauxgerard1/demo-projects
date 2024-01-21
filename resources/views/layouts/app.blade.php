<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>          
    </head>
    <body
        class="font-inter antialiased bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400"
        :class="{ 'sidebar-expanded': sidebarExpanded }"
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"    
    >

        <script>
            if (localStorage.getItem('sidebar-expanded') == 'true') {
                document.querySelector('body').classList.add('sidebar-expanded');
            } else {
                document.querySelector('body').classList.remove('sidebar-expanded');
            }
        </script>

        <!-- Page wrapper -->
        <div class="flex h-screen overflow-hidden">

            <x-app.sidebar />

            <!-- Content area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if($attributes['background']){{ $attributes['background'] }}@endif" x-ref="contentarea">

                <x-app.header />

                <main>
                    {{ $slot }}
                </main>

            </div>

        </div>

        @livewireScripts

        <script>
            window.addEventListener('show-delete-confirmation', event => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir los cambios",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteConfirmed');
                    }
                })
            });
    
            window.addEventListener('clienteBorrado', event => {
                Swal.fire('Cliente borrado correctamente!', event.detail.message, 'success')
            });

            window.addEventListener('tareaBorrada', event => {
                Swal.fire('Tarea borrada correctamente!', event.detail.message, 'success')
            });

            window.addEventListener('proyectoBorrado', event => {
                Swal.fire('Proyecto borrado correctamente!', event.detail.message, 'success')
            });
    
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                // timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
    
            Livewire.on('alert', function(message) {
                Toast.fire(
                    message,
                    '',
                    'success'
                )
            })
            Livewire.on('error', function(message) {
                Toast.fire(
                    message,
                    '',
                    'error'
                )
            })
        </script>

    </body>
</html>
