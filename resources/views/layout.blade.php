<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    @include('includes.styles')
    @stack('styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('includes.navbar')
            @include('includes.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    @php
                        if (date('Y') == 2020) {
                            $year = "2020";
                        } else {
                            $year = "2020 - ".date('Y');
                        }
                    @endphp
                    Copyright &copy; {{ $year }} <div class="bullet"></div> {{ config('app.name') }}
                </div>
            </footer>
        </div>
    </div>

    @stack('modals')

    @include('includes.scripts')
    @stack('scripts')
</body>

</html>
