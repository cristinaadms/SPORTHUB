<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SportHub')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-primary': '#2563EB',
                        'blue-hover': '#1D4ED8',
                        'blue-light': '#EFF6FF',
                        'blue-text': '#1E40AF',
                        'gray-secondary': '#6B7280',
                        'gray-light': '#E5E7EB'
                    }
                }
            }
        }
    </script>

    @stack('styles')
</head>

<body class="bg-gray-50 pb-20">
    <!-- Container para alerts -->
    <div class="max-w-md mx-auto mt-6">
        {{-- Erros de validação --}}
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md px-4 space-y-2">
            {{-- Erros de validação --}}
            @if ($errors->any())
                <x-alert type="error" dismissible>
                    <p class="font-semibold mb-1">Por favor, corrija os seguintes erros:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif

            {{-- Mensagens de sessão --}}
            @if (session('success'))
                <x-alert type="success" dismissible>
                    {{ session('success') }}
                </x-alert>
            @endif

            @if (session('error'))
                <x-alert type="error" dismissible>
                    {{ session('error') }}
                </x-alert>
            @endif
        </div>


        {{-- Mensagens de sessão --}}
        @if (session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif
        @if (session('error'))
            <x-alert type="error">
                {{ session('error') }}
            </x-alert>
        @endif
    </div>

    @yield('content')

    <x-menu-inferior />

    @stack('scripts')
</body>

</html>
