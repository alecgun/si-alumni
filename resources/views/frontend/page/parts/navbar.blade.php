<div class="container">
    <a class="navbar-brand" href="{{ route('landing.home') }}">
        <img src="{{ asset('frontend-assets/images/sman1blitar.webp') }}" alt="SMAN 1 BLITAR" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="mdi mdi-menu text-muted"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navbar-navList">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('landing.dataAlumni') }}">Data Alumni</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @endguest
            @auth
                @role('user')
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Tiket Bantuan
                            <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="nav-link" href="{{ route('landing.ticket.open') }}">Buka Tiket</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('landing.ticket.history') }}">Riwayat Tiket</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ ucfirst(strtolower(explode(' ', auth()->user()->name)[0])) }}
                            <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="nav-link" href="{{ route('landing.biodata') }}">Biodata</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endrole
            @endauth
        </ul>
        <!--end navbar-nav-->
    </div>
    <!--end collapse-->
</div>
<!--end container-->
