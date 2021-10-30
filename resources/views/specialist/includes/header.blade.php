<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('specialist') }}" class="logo">
            <img src="{{ asset('images/logo-h.png') }}" alt="Logo">
            <!-- <span class="logo-lg"><b>Avivare</b></span>
        <span class="logo-mini"><b>Avivare</b></span> -->
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="header-page-title">
                <h1>@yield('title')</h1>
            </div>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Control Sidebar Toggle Button -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Você tem 0 notificações</li>
                            {{-- <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar-check-o"></i> Novo agendamento realizado
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar-check-o"></i> Novo agendamento realizado
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar-check-o"></i> Novo agendamento realizado
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar-check-o"></i> Novo agendamento realizado
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar-check-o"></i> Novo agendamento realizado
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- <li class="footer"><a href="#">Ver tudo</a></li> --}}
                        </ul>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#">
                            <span class="hidden-xs">{{ auth('specialist')->user()->name }}</span>
                        </a>
                    </li>
                    <li id="li-logout">
                        <a href="{{ url('/specialist/logout') }}"><i class="fa fa-sign-out"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
