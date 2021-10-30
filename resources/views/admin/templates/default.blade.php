<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        @include('admin.includes.head')
    </head>

    <body class="hold-transition skin-asga fixed sidebar-mini{{ (Request::is('admin/crm/*') ? ' sidebar-collapse fixed' : '') }}">

        @include('admin.includes.header')

        @include('admin.includes.sidebar')

        @yield('content')

        @include('admin.includes.modals')

        @yield('modals')

        @include('admin.includes.footer')
        @include('global.alerts')

        @yield('scripts')

    </body>

</html>
