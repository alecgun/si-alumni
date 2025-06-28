@extends('frontend.page.parts.master')
@section('content')
    <!-- START HERO -->
    <section class="bg-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white">
                        <h2 class="text-white fw-bold">Daftar Alumni</h2>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END HERO -->
    <!-- START MAIN -->
    <section class="section bg-light p-0" id="alumni">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body py-4">
                        <div id="data_alumni_table">
                            <table id="table_data_alumnis" class="table card" width="100%">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END MAIN -->
@endsection

@push('customScripts')
    <script>
        $(document).ready(function() {
            var table = $('#table_data_alumnis').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('landing.alumni') }}',
                columns: [{
                    class: 'text-start img_user',
                    data: 'img_user',
                    name: 'img_user',
                    render: function(data, type, row) {
                        return `
                        <div class="row align-items-center ps-2">
                            <div class="col-auto">
                                <img src="${row.img_user ? ('{{ asset('storage') }}/' + row.img_user) : ('{{ asset('frontend-assets/images/users/placeholder.png') }}')}" alt="Alumni Photo" class="img-fluid foto ratio-4x5">
                            </div>
                            <div class="col">
                                <p class="nama fw-bold">${row.nama}</p>
                            </div>
                        </div>
                        <hr style="border-top: 1px solid #ccc; margin: 10px 0;">
                        <div class="row align-items-center ps-2">
                            <div class="col">
                                <i class="fas fa-school text-primary me-2" style="width: 15px;"></i>
                                <span>${row.kelas}</span>
                            </div>
                        </div>
                        <div class="row align-items-center ps-2">
                            <div class="col">
                                <i class="fas fa-graduation-cap text-primary me-2" style="width: 15px;"></i>
                                <span>${row.tahun_lulus}</span>
                            </div>
                        </div>
                        <div class="row align-items-center ps-2">
                            <div class="col">
                                <i class="fab fa-instagram text-primary me-2" style="width: 15px;"></i>
                                <span><a href="https://instagram.com/${row.instagram}"
                                        target="_blank" class="text-decoration-none">
                                        ${row.instagram}
                                    </a></span>
                            </div>
                        </div>
                        `;
                    }
                }, ],
                lengthChange: false,
                pageLength: 12,
            });
        });
    </script>
@endpush

@push('customStyles')
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');

        .bg-blue {
            padding: 150px 0 80px 0;
            position: relative;
            background-color: #135fc9;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        #alumni {
            display: grid;
            grid-template-rows: auto 1fr auto;
            grid-template-columns: 100%;

            /* fallback height */
            min-height: 100vh;

            /* new small viewport height for modern browsers */
            min-height: 100svh;
        }

        .card {
            border: 0 !important;
            background-color: transparent;
        }

        .form-control#dt-search-0 {
            padding: 6px 10px;
        }

        .card thead {
            display: none;
        }

        #table_data_alumnis tbody {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 5px;
        }

        #table_data_alumnis td {
            display: flex;
            flex-direction: column;
            width: 20em;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        img.foto {
            height: 100px;
            object-fit: cover;
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            ...
        }

        .ratio-4x5 {
            aspect-ratio: 4/5;
        }
    </style>
@endpush
