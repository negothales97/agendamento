<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li {{ request()->is('specialist') ? 'class=active' : '' }}>
                <a href="{{ route('specialist.dashboard.index') }}">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>

            <li {{ request()->is('specialist/calendar*') ? 'class=active' : '' }}>
                <a href="{{ route('specialist.calendar.index') }}">
                    <i class="fa fa-calendar"></i> <span>Calendário</span>
                </a>
            </li>
            <li {{ request()->is('specialist/balances*') ? 'class=active' : '' }}>
                <a href="{{ route('specialist.balance.index') }}">
                    <i class="fa fa-money"></i> <span>Movimentações</span>
                </a>
            </li>
            <li {{ request()->is('specialist/place*') ? 'class=active' : '' }}>
                <a href="{{ route('specialist.place.index') }}">
                    <i class="fa fa-map-pin"></i> <span>Locais de atendimento</span>
                </a>
            </li>
            <li {{ request()->is('specialist/calls*') ? 'class=active' : '' }}>
                <a href="{{ route('specialist.call.index') }}">
                    <i class="fa fa-video-camera"></i> <span>Chamada de vídeo</span>
                    {{-- <span class="pull-right-container">
                        <small class="label pull-right bg-red">1</small>
                    </span> --}}
                </a>
            </li>
            {{-- <li {{ request()->is('admin/chat*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.chat') }}">
                    <i class="fa fa-wechat"></i> <span>Chat</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">3</small>
                    </span>
                </a>
            </li>
            <li {{ request()->is('admin/call*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.call') }}">
                    <i class="fa fa-video-camera"></i> <span>Chamada de vídeo</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">1</small>
                    </span>
                </a>
            </li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
