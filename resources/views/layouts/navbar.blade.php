<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('admin/img/logo_if.png') }}" class="rounded-circle mr-1 bg-white">
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->nama }}</div>

            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item has-icon">{{ strtoupper(Auth::user()->roles->pluck('name')[0] ?? "-") }}</a>
                <div class="dropdown-divider">
                </div>
                <a class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
