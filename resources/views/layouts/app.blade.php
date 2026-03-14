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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css" integrity="sha512-M5Kq4YVQrjg5c2wsZSn27Dkfm/2ALfxmun0vUE3mPiJyK53hQBHYCVAtvMYEC7ZXmYLg8DVG4tF8gD27WmDbsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" integrity="sha512-6BTOlkauINO65nLhXhthZMtepgJSghyimIalb+crKRPhvhmsCdnIuGcVbR5/aQY2A+260iC1OPy1oCdB6pSSwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        @stack('modals')
    </body>
</html>
