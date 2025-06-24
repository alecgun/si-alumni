@extends('backend.parts.auth.master')
@section('content')
    <div class="d-flex flex-row-fluid flex-center flex-lg-row">
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end">
            <!--begin::Card-->
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-500px p-10">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                        action="{{ route('login.post') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="d-flex flex-center flex-column">
                            <!--begin::Logo-->
                            <a href="{{ route('landing.home') }}" class="mb-7">
                                <img alt="Logo" src="backend-assets/media/logos/sman1blitar.webp" class="h-125px" />
                            </a>
                            <!--end::Logo-->
                            <!--begin::Title-->
                            <h2 class="fw-normal fs-3 mb-5">Sistem Pendataan Alumni SMAN 1 Blitar</h2>
                            <!--end::Title-->
                        </div>
                        <div class="text-center mb-5">
                            <!--begin::Title-->
                            <h1 class="text-gray-900 fw-bolder mb-2">Masuk</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Separator-->
                        <div class="separator separator-content my-10">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">Masuk disini</span>
                        </div>
                        <!--end::Separator-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Username-->
                            <input type="text" placeholder="Username" name="username" autocomplete="off"
                                class="form-control bg-transparent @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" />
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <!--end::Username-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-10 position-relative">
                            <!--begin::Password-->
                            <input type="password" placeholder="Password" name="password" autocomplete="off"
                                class="form-control bg-transparent @error('password') is-invalid @enderror" />
                            <span class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y"
                                onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye"></i>
                            </span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <!--end::Password-->
                        </div>
                        <!--end::Input group=-->

                        <!--begin::Input group=-->
                        <div class="fv-row mb-10">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="remember" />
                                <span class="form-check-label text-gray-700 fw-bold">Ingat Saya</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Input group=-->

                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Masuk</span>
                                <!--end::Indicator label-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
@endsection
@push('customScripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ $errors->first() }}',
            });
        </script>
    @endif

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.querySelector('input[name="password"]');
            const eyeIcon = document.querySelector('.fa-eye');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
@endpush
