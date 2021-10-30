<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li {{ request()->is('admin') ? 'class=active' : '' }}>
                <a href="{{ route('admin.dashboard.index') }}">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>
            <li {{ request()->is('admin/balances*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.balance.index') }}">
                    <i class="fa fa-money"></i> <span>Movimentações</span>
                </a>
            </li>
            <li {{ request()->is('admin/admins*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.admin.index') }}">
                    <i class="fa fa-users"></i> <span>Colaboradores</span>
                </a>
            </li>
            <li {{ request()->is('admin/customers*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.customer.index') }}">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                </a>
            </li>
            <li {{ request()->is('admin/posts*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.post.index') }}">
                    <i class="fa fa-bookmark"></i> <span>Posts</span>
                </a>
            </li>
            <li {{ request()->is('admin/specialties*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.specialty.index') }}">
                    <i class="fa fa-tags"></i> <span>Especialidades</span>
                </a>
            </li>
            <li {{ request()->is('admin/specialists*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.specialist.index') }}">
                    <i class="fa fa-user"></i> <span>Especialistas</span>
                </a>
            </li>
            <li {{ request()->is('admin/variables*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.variable.edit', ['id' => 1]) }}">
                    <i class="fa fa-cog"></i> <span>Configurações</span>
                </a>
            </li>
            <li class="treeview {{ request()->is('admin/page*', 'admin/link*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-file-text" aria-hidden="true"></i><span>Páginas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ request()->is('admin/pages*') ? 'menu-open' : '' }}">
                    <li class="{{ request()->is('admin/pages/edit/1') ? 'active' : '' }}">
                        <a href="{{ route('admin.page.edit', ['id' => 1]) }}">
                            <i class="fa fa-circle-o"></i>Ajuda e suporte
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/pages/edit/2') ? 'active' : '' }}">
                        <a href="{{ route('admin.page.edit', ['id' => 2]) }}">
                            <i class="fa fa-circle-o"></i> Termos e condições
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/pages/edit/3') ? 'active' : '' }}">
                        <a href="{{ route('admin.page.edit', ['id' => 3]) }}">
                            <i class="fa fa-circle-o"></i> Sobre este App
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/pages/edit/4') ? 'active' : '' }}">
                        <a href="{{ route('admin.page.edit', ['id' => 4]) }}">
                            <i class="fa fa-circle-o"></i> Política de privacidade
                        </a>
                    </li>
                </ul>
            </li>

            {{-- <li {{ Request::is('admin/calendar*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.calendar') }}">
                    <i class="fa fa-calendar"></i> <span>Calendário</span>
                </a>
            </li>

            <li {{ Request::is('admin/customer*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.customers') }}">
                    <i class="fa fa-map-pin"></i> <span>Locais de atendimento</span>
                </a>
            </li>
            <li {{ Request::is('admin/chat*') ? 'class=active' : '' }}>
                <a href="{{ route('admin.chat') }}">
                    <i class="fa fa-wechat"></i> <span>Chat</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">3</small>
                    </span>
                </a>
            </li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
