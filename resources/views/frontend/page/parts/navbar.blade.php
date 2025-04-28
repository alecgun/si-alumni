<div class="container">
    <a class="navbar-brand" href="{{ route('landing.home') }}">SMAN 1 BLITAR</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="mdi mdi-menu text-muted"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navbar-navList">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('landing.dataAlumni') }}">Data Alumni</a>
            </li>
            <li class="nav-item align-self-center justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-primary"
                    style="height: 40px; display: flex; align-items: center;">Login</a>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Blog <i class="mdi mdi-chevron-down"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li>
                        <a class="nav-link" href="blog-list.html">Blog List</a>
                    </li>
                    <li>
                        <a class="nav-link" href="blog-details.html">Blog Details</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
        <!--end navbar-nav-->
    </div>
    <!--end collapse-->
</div>
<!--end container-->
