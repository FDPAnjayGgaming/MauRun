<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MauRun') }} — Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.navigation')

        {{-- Content --}}
        <div class="flex-1 ml-64">

            @isset($header)
                <header class="page-header">
                    <div class="px-8 py-5">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-8">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>
</html>