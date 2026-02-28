<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite([
            'resources/css/app.css',
            'resources/css/theme.min.css',
            'resources/js/jquery.min.js',
            'resources/js/vendors.min.js',
            'resources/js/app.js',
            'resources/js/common-init.min.js',
        ])
    </head>
    <body>
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Topbar --}}
        <x-topbar />

        {{-- Main Content --}}
        <main class="nxl-container">
            <div class="nxl-content">
                @isset($header)
                    <div class="page-header">
                        <div class="page-header-left d-flex align-items-center">
                            <div class="page-header-title">
                                {{ $header }}
                            </div>
                        </div>
                    </div>
                @endisset

                <div class="main-content">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
