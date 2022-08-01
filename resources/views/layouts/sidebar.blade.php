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
                <a class="nav-link" href="blank.html">
                    <i class="fas fa-columns"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Manajemen Barang</li>
                <li class="@yield('barang')"><a class="nav-link" href="{{ url('barang') }}"><i class="fas fa-archive"></i> <span>Barang</span></a></li>
            <li class="menu-header">Manajemen Ruangan</li>
            <li class="@yield('inventaris')"><a class="nav-link" href="{{ url('ruangan') }}"><i
                        class="fas fa-door-open"></i> <span>Ruangan</span></a></li>
            <li class="menu-header">Manajemen Inventaris</li>
                <li class="@yield('vendor')"><a class="nav-link" href="{{ url('admin/vendor') }}"><i
                    class="fas fa-tags"></i> <span>Vendor</span></a></li>
            <li class="@yield('inventaris_komputer')"><a class="nav-link" href="{{ url('admin/barang') }}"><i
                        class="fas fa-desktop"></i> <span>Inventaris Komputer</span></a></li>
            <li class="@yield('peminjaman')"><a class="nav-link" href="{{ url('peminjaman') }}"><i
                        class="fas fa-people-carry"></i> <span>Peminjaman</span></a></li>
            <li class="menu-header">Laporan</li>
            <li class="@yield('peminjaman')"><a class="nav-link" href="{{ url('admin/barang') }}"><i
                        class="fas fa-file-pdf"></i> <span>Laporan Tahunan</span></a></li>
        </ul>
    </aside>
</div>
