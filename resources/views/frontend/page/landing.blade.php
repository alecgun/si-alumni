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

    <!-- START FEATURES -->
    <section class="section" id="features">
        <div class="container">
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
                <div class="col-lg-12">
                    <canvas id="main-chart"></canvas>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END FEATURES -->

    <!-- START BLOG -->
    <section class="section" id="blog">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-4">
                        <h3>Our Blog</h3>
                        <p class="text-muted mt-2 mb-0">It is a long established fact that a reader will be of a page
                            when
                            established fact looking at its layout.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card blog-box border-0 mt-4">
                        <div class="blog-img position-relative">
                            <img src="images/blog/blog-01.jpg" alt="Blog" class="img-fluid rounded">
                            <div class="bg-overlay rounded"></div>
                            <div class="author">
                                <h6 class="fs-16 mb-0"><i class="mdi mdi-account-outline fs-17 align-middle me-1"></i>
                                    Calvin Carlo</h6>
                                <small><i class="mdi mdi-clock-outline fs-17 align-middle me-1"></i> 20th March
                                    2021</small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="primary-link">
                                <h6 class="fs-20">Doing a cross country road trip</h6>
                            </a>
                            <p class="text-muted">We craft digital, graphic and dimensional thinking, to create
                                category
                                leading brand.</p>
                            <div class="mt-3">
                                <a href="#" class="text-primary">Read More <i
                                        class="mdi mdi-arrow-right align-middle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card blog-box border-0 mt-4">
                        <div class="blog-img position-relative">
                            <img src="images/blog/blog-02.jpg" alt="Blog" class="img-fluid rounded">
                            <div class="bg-overlay rounded"></div>
                            <div class="author">
                                <h6 class="fs-16 mb-0"><i class="mdi mdi-account-outline fs-17 align-middle me-1"></i>
                                    Theresa Sinclair</h6>
                                <small><i class="mdi mdi-clock-outline fs-17 align-middle me-1"></i> 01th July
                                    2021</small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="primary-link">
                                <h6 class="fs-20">New exhibition at our Museum</h6>
                            </a>
                            <p class="text-muted">Even the all-powerful Pointing has no control about the blind almost
                                unorthographic.</p>
                            <div class="mt-3">
                                <a href="#" class="text-primary">Read More <i
                                        class="mdi mdi-arrow-right align-middle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card blog-box border-0 mt-4">
                        <div class="blog-img position-relative">
                            <img src="images/blog/blog-03.jpg" alt="Blog" class="img-fluid rounded">
                            <div class="bg-overlay rounded"></div>
                            <div class="author">
                                <h6 class="fs-16 mb-0"><i class="mdi mdi-account-outline fs-17 align-middle me-1"></i>
                                    Ruben Reed</h6>
                                <small><i class="mdi mdi-clock-outline fs-17 align-middle me-1"></i> 25th July
                                    2021</small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="primary-link">
                                <h6 class="fs-20">Design your apps in your own way</h6>
                            </a>
                            <p class="text-muted">Pityful a rethoric question ran over her cheek, then she continued
                                her
                                way.</p>
                            <div class="mt-3">
                                <a href="#" class="text-primary">Read More <i
                                        class="mdi mdi-arrow-right align-middle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BLOG -->

    <!--start contact-->
    <section class="section bg-light" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-5">
                        <h3>Contact Us</h3>
                        <p class="text-muted mt-2">It is a long established fact that a reader will be of a page when
                            established fact looking at its layout.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-details mb-4 mb-lg-0">
                        <p class="mb-3"><i class="mdi mdi-email-outline align-middle text-muted fs-20 me-2"></i>
                            <span class="fw-medium">support@website.com</span>
                        </p>
                        <p class="mb-3"><i class="mdi mdi-web align-middle text-muted fs-20 me-2"></i> <span
                                class="fw-medium">www.website.com</span></p>
                        <p class="mb-3"><i class="mdi mdi-phone align-middle text-muted fs-20 me-2"></i> <span
                                class="fw-medium">+245 1234 5678</span></p>
                        <p class="mb-3"><i class="mdi mdi-hospital-building text-muted fs-20 me-2"></i> <span
                                class="fw-medium">9:00 AM - 6:00 PM</span></p>
                        <p class="mb-3"><i class="mdi mdi-map-marker-outline text-muted fs-20 me-2"></i> <span
                                class="fw-medium">412, Plantation Rd, Morehead City, NC, 28557.</span></p>
                    </div>
                    <!--end contact-details-->
                </div>
                <!--end col-->
                <div class="col-lg-7">
                    <form method="post" onsubmit="return validateForm()" class="contact-form" name="myForm"
                        id="myForm">
                        <span id="error-msg"></span>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                    <input name="name" id="name" type="text" class="form-control"
                                        placeholder="Enter your name*">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <input name="email" id="email" type="email" class="form-control"
                                        placeholder="Enter your email*">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text"><i class="mdi mdi-file-document-outline"></i></span>
                                    <input name="subject" id="subject" type="text" class="form-control"
                                        placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text align-items-start"><i
                                            class="mdi mdi-comment-text-outline"></i></span>
                                    <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Enter your message*"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-end">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="Send Message">
                            </div>
                        </div>
                    </form>
                    <!--end form-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end contact-->
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
                }
            }
        };

        const mainChart = new Chart(
            document.getElementById('main-chart'),
            config // We'll add the configuration details later.
        );
    </script>
@endpush
