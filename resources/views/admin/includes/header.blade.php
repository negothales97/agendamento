<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('admin')}}" class="logo">
      <img src="{{ asset('images/logo-h.png')}}" alt="Logo">
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
          <li class="dropdown user user-menu">
            <a href="{{route('admin.admin.edit',['id'=> auth('admin')->id()])}}">
              <span class="hidden-xs">{{ auth('admin')->user()->name}}</span>
            </a>
          </li>
          <li id="li-logout">
            <a href="{{ url('/admin/logout') }}"><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
