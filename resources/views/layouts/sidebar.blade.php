<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Sistem Inventaris</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="@yield('dashboard')">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fas fa-columns"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Master Data</li>
            <li class="@yield('gedung')"><a class="nav-link" href="{{ url('gedung') }}">
                <i class="fas fa-building"></i><span>Gedung</span></a></li>
            <li class="@yield('ruangan')"><a class="nav-link" href="{{ url('ruangan') }}"><i
                        class="fas fa-door-open"></i> <span>Ruangan</span></a></li>
                <li class="@yield('barang')"><a class="nav-link" href="{{ url('barang') }}"><i class="fas fa-archive"></i> <span>Barang</span></a></li>
            <li class="@yield('vendor')"><a class="nav-link" href="{{ url('vendor') }}"><i
                            class="fas fa-tags"></i> <span>Vendor</span></a></li>
            <li class="menu-header">Manajemen Inventaris</li>
            <li class="@yield('inventaris')"><a class="nav-link" href="{{ url('inventaris') }}"><i
                        class="fas fa-boxes"></i> <span>Inventaris</span></a></li>
            <li class="@yield('peminjaman')"><a class="nav-link" href="{{ url('peminjaman') }}"><i
                        class="fas fa-people-carry"></i> <span>Peminjaman</span></a></li>
            <li class="menu-header">Laporan</li>
            <li class="@yield('laporan')"><a class="nav-link" href="{{ url('laporan') }}"><i
                        class="fas fa-file-pdf"></i> <span>Laporan</span></a></li>
            <li class="menu-header">User Manajemen</li>
            <li class="@yield('users')"><a class="nav-link" href="{{ url('users') }}"><i
                        class="fas fa-users"></i> <span>Users</span></a></li>
        </ul>
    </aside>
</div>
