<!DOCTYPE html>
<html lang="en">
@include('frontend.page.parts.header')

<body data-bs-spy="scroll" data-bs-target="#navbar-navlist" data-bs-offset="60">

    <!--start page Loader -->
    <div id="preloader">
        <div id="status">
            <div class="load">
                <hr />
                <hr />
                <hr />
                <hr />
            </div>
        </div>
    </div>
    <!--end page Loader -->

    <!-- START NAVBAR -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top sticky">
        @include('frontend.page.parts.navbar')
    </nav>
    <!-- END NAVBAR -->

    @yield('content')

    <!-- START FOOTER -->
    <footer class="bg-dark section">
        @include('frontend.page.parts.footer')
    </footer>
    <!-- END FOOTER -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <!--end back-to-top-->

    <!-- Bootstrap Bundale js -->
    <script src="{{ asset('frontend-assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Swiper Slider js -->
    <script src="{{ asset('frontend-assets/js/swiper-bundle.min.js') }}"></script>

    <!-- Contact Js -->
    <script src="{{ asset('frontend-assets/js/contact.js') }}"></script>

    <!-- Index-init Js -->
    <script src="{{ asset('frontend-assets/js/index.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('frontend-assets/js/app.js') }}"></script>

    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.dataTables.js"></script>

    @stack('customScripts')
</body>

</html>
