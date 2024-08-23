<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>
    @livewire('notifications')

    <body class="antialiased bg-amber-100">

    <div class="flex items-center justify-center h-screen">

        <div class="bg-white text-white font-bold rounded-lg border shadow-lg p-10">
            {{ $slot }}
        </div>

    </div>


        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
