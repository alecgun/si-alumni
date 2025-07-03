@extends('frontend.page.parts.master')
@section('content')
    <!-- start-HOME -->
    @guest
        <section class="bg-home6 overflow-hidden" id="home"
            style="background-image: url({{ asset('frontend-assets/images/home/smasa.jpg') }});">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center text-white">
                            <h6 class="home-subtitle mb-4">SMAN 1 Blitar</h6>
                            <h1 class="fw-bold">Sistem Pendataan Alumni</h1>
                            <p class="home-desc pt-3">Website ini menyediakan sarana bagi alumni untuk memperbarui data
                                lulusan SMAN 1 Blitar yang melanjutkan ke jenjang kuliah maupun kerja.</p>
                            <div class="mt-4 pt-3">
                                <a href="{{ route('login') }}" class="btn me-2 btn-primary">Login</a>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
        <!-- END HOME -->
    @endguest

    <!-- START CHART -->
    <section class="section" id="features">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-5">
                        <h3 class="fw-bold">Grafik Alumni</h3>
                        <p class="text-muted">Jumlah Lulusan Alumni SMAN 1 Blitar dalam 5 tahun terakhir.</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <!--start row-->
            <div class="row">
                <div id="landing-chart" class="col-lg-12">
                    <canvas id="main-chart"></canvas>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END CHART -->

    <!-- START BLOG -->
    <section class="section" id="blog">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Pengumuman</h3>
                        <p class="text-muted mt-2 mb-0">Informasi terbaru terkait alumni SMAN 1 Blitar akan ditampilkan
                            disini.</p>
                    </div>
                </div>
            </div>
            <div class="row" id="pengumuman">
            </div>
        </div>
    </section>
    <!-- END BLOG -->
@endsection

@push('customScripts')
    <script>
        const data = {
            labels: @json($data->map(fn($data) => $data->tahun_lulus)),
            datasets: [{
                    label: 'Laki-laki',
                    data: @json($data->map(fn($data) => $data->jumlah_laki)),
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    barPercentage: 0.5,
                    borderRadius: 5,
                },
                {
                    label: 'Perempuan',
                    data: @json($data->map(fn($data) => $data->jumlah_perempuan)),
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    barPercentage: 0.5,
                    borderRadius: 5,
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 10,
                    }
                },
                maintainAspectRatio: false,
            }
        };

        const mainChart = new Chart(
            document.getElementById('main-chart'),
            config
        );

        getPengumuman();

        function getPengumuman() {
            $.ajax({
                url: '{{ route('landing.pengumuman.data') }}',
                method: 'GET',
                success: function(response) {
                    let pengumumanHTML = '';
                    if (response.pengumuman.length > 0) {
                        let itemsDisplayed = 0;

                        response.pengumuman.forEach(function(pengumuman) {
                            if (itemsDisplayed >= 3) return;
                            let pengumumanSlug = pengumuman.slug;
                            let pengumumanUrl = '{{ route('landing.pengumuman.show', ':slug') }}'
                                .replace(
                                    ':slug',
                                    pengumumanSlug);
                            let pengumumanFoto = pengumuman.foto;
                            let pengumumanFotoSrc = '{{ asset('storage') }}/' + pengumumanFoto;
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
                            itemsDisplayed++;
                        });
                    } else {
                        pengumumanHTML +=
                            `<p class="text-muted text-center">Data pengumuman tidak ditemukan.</p>`;
                    }
                    $('#pengumuman').html(pengumumanHTML);
                }
            });
        }
    </script>
@endpush

@push('customStyles')
    <style>
        #pengumuman {
            display: flex;
            flex-wrap: wrap;
        }

        .ratio-4x3 {
            aspect-ratio: 4/3;
        }

        #landing-chart {
            min-height: 500px;
        }
    </style>
@endpush
