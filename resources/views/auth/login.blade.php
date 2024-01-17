<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 dark:text-slate-800 font-bold mb-6">{{ __('Iniciar Sesión') }}</h1>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <div>
        <div
            class="min-w-full px-4 py-2 rounded-sm text-sm border bg-amber-100 dark:bg-amber-400/30 border-amber-200 dark:border-transparent text-amber-600 dark:text-amber-400">
            <div class="flex w-full justify-between items-start">
                <div class="flex flex-col">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                        </svg>
                        <div>Ingresá con los siguiente datos</div>
                    </div>
                    <div class="flex items-center px-7">
                        <div>Usuario: demo@demo.com</div>
                    </div>
                    <div class="flex items-center px-7">
                        <div>Contraseña: demo1234</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-4 pt-4">
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    placeholder="demo@demo.com" value="demo@demo.com"/>
            </div>
            <div>
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="demo1234" value="demo1234" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <div class="mr-1">
                <a class="text-sm underline hover:no-underline">
                </a>
            </div>
            <x-jet-button class="ml-3">
                {{ __('Ingresar') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
</x-authentication-layout>
