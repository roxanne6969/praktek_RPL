<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB ATMIN <sup>2</sup></div>
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
        MASTER
    </div>

    <li class="nav-item {{ Request::is('admin/berita*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('berita.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Berita</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/kategori*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Kategori</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/user*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data User</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/page*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('page.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Page</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/menu*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('menu.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Menu</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>