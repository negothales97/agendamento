<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        @include('specialist.includes.head')
    </head>

    <body class="hold-transition skin-asga fixed sidebar-mini">

        @include('specialist.includes.header')

        @include('specialist.includes.sidebar')

        @yield('content')

        @include('specialist.includes.modals')

        @yield('modals')

        @include('specialist.includes.footer')
        @include('global.alerts')

        @yield('scripts')

    </body>

</html>
