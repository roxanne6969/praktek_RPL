<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Berita</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Master
    </div>

    <li class="nav-item {{ Request::is('admin/berita*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('berita.index') }}">
            <i class="fas fa-fw fa-copy"></i>
            <span>Berita</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/kategori*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Kategori</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/user*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Website
    </div>

    <li class="nav-item {{ Request::is('admin/page*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('page.index') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Halaman (Page)</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/menu*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('menu.index') }}">
            <i class="fas fa-fw fa-bars"></i>
            <span>Manajemen Menu</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/reset-password*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.resetPassword') }}">
            <i class="fas fa-fw fa-key"></i>
            <span>Reset Password</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>