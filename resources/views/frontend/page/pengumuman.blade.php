@extends('frontend.page.parts.master')
@section('content')
    <!-- START HERO -->
    <section class="bg-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white">
                        <h2 class="text-white fw-bold">Pengumuman</h2>
                        <p class="text-white-50  mb-0">Informasi terbaru terkait alumni SMAN 1 Blitar akan ditampilkan
                            disini.
                        </p>
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
    <section class="section bg-light py-5" id="blog">
        <div class="container">
            <div class="row" id="pengumuman">
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
            getPengumuman();

            function getPengumuman() {
                $.ajax({
                    url: '{{ route('landing.pengumuman.data') }}',
                    method: 'GET',
                    success: function(response) {
                        let pengumumanHTML = '';
                        if (response.pengumuman.length > 0) {
                            response.pengumuman.forEach(function(pengumuman) {
                                let pengumumanSlug = pengumuman.slug;
                                let pengumumanUrl =
                                    '{{ route('landing.pengumuman.show', ':slug') }}'
                                    .replace(
                                        ':slug',
                                        pengumumanSlug);
                                let pengumumanFoto = pengumuman.foto;
                                let pengumumanFotoSrc = '{{ asset('storage') }}/' +
                                    pengumumanFoto;
                                pengumumanHTML += `
                                <div class="col-lg-4 col-md-6 pengumuman-item">
                                    <div class="card blog-box border-0 mt-4">
                                        <div class="blog-img position-relative ratio ratio-4x3">
                                            <img src="${pengumumanFotoSrc}" alt="Blog" class="img-fluid rounded" style="object-fit: cover;">
                                            <div class="bg-overlay rounded"></div>
                                            <div class="author">
                                                <small>
                                                    <i class="mdi mdi-clock-outline fs-17 align-middle me-1"></i>
                                                    ${moment(pengumuman.created_at).locale('id').format('D MMMM YYYY, HH:mm')}
                                                </small>
                                            </div>
                                            <a href="${pengumumanUrl}" class="text-primary"></a>
                                        </div>
                                        <div class="mt-3 p-1">
                                            <p class="text-muted mb-0">${moment(pengumuman.created_at).locale('id').fromNow()}</p>
                                            <a href="${pengumumanUrl}" class="primary-link">
                                                <h6 class="fs-20">${pengumuman.judul}</h6>
                                            </a>
                                            <div class="mt-3">
                                                <a href="${pengumumanUrl}" class="text-primary">Read More <i class="mdi mdi-arrow-right align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            });
                        } else {
                            pengumumanHTML +=
                                `<p class="text-muted text-center">Data pengumuman tidak ditemukan.</p>`;
                        }
                        $('#pengumuman').html(pengumumanHTML);
                    }
                });
            }
        });
    </script>
@endpush

@push('customStyles')
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');

        #blog {
            display: grid;
            grid-template-rows: auto 1fr auto;
            grid-template-columns: 100%;

            /* fallback height */
            min-height: 50vh;

            /* new small viewport height for modern browsers */
            min-height: 50svh;
        }

        .bg-blue {
            padding: 150px 0 80px 0;
            position: relative;
            background-color: #135fc9;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .ratio-4x3 {
            aspect-ratio: 4/3;
        }

        .blog-box {
            overflow: hidden;
            background: transparent;
        }
    </style>
@endpush
