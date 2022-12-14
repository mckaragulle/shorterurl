<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @livewireStyles
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        @livewire('shorter')
        @livewireScripts
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 
    </body>
</html>
