@extends('frontend.page.parts.master')
@section('content')

    <!-- START MAIN -->
    <section class="section bg-light" id="alumni">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 mt-4 text-center">
                    <div class="title-heading">
                        <h1 class="heading mb
                        -3">Data Alumni</h1>
                        <p class="para-desc mx-auto text-muted">Berikut adalah data alumni SMAN 1 Blitar</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-12 mt-6">
                    <div class="row">
                        @foreach ($alumniData as $data)
                            <div class="col-lg-3 mt-4 pt-2">
                                <div class="card alumni-card border-0 rounded shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content">
                                            <div class="photo-frame me-3">
                                                <img src="{{ asset('frontend-assets/images/home/messi.png') }}"
                                                    alt="Alumni Photo" class="img-fluid rounded"
                                                    style="width: 75px; height: 100px;">
                                            </div>
                                            <div>
                                                <h5
                                                    class="text-muted
                                                text-uppercase">
                                                    {{ $data->nis }}</h5>
                                                <h5 class="text-uppercase">{{ $data->nama }}</h5>
                                                <p
                                                    class="text-muted
                                                text-uppercase">
                                                    {{ $data->kelas }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

    <!-- Modal -->
    <div class="modal fade" id="presentationVideo" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content  bg-transparent border-0">
                <div class="modal-body p-0">
                    <div class="text-end">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="ratio ratio-16x9">
                        <video id="VisaChipCardVideo" class="video-box" controls>
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end modal-->


    <!--start subscribe-Modal -->
    <div class="subscribe-modal modal fade" id="subscribe" tabindex="-1" aria-labelledby="subscribeform"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body text-center pt-0">
                    <img src="images/subscribe.png" alt="subscribe" class="img-fluid" />
                    <h5 class="modal-title mt-2 mb-2" id="subscribeform">Subscribe</h5>
                    <p class="text-muted mb-4">
                        Join your hand with us for a better life <br /> and beautiful future.
                    </p>
                    <form action="#">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control border" id="subscribeemail"
                                placeholder="Enter your email" />
                            <button class="btn  btn-primary btn-sm" type="submit"
                                id="button-addon2">Subscribe</button>
                        </div>
                    </form>
                </div>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end SUBSCRIBE modal-->
