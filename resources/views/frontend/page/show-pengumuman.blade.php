@extends('frontend.page.parts.master')
@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post-->
                    <article class="position-relative">
                        <div class="post-preview mb-4">
                            <img src="{{ asset('storage/' . $pengumuman->foto) }}" alt="" class="img-fluid rounded">
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-3">
                                <p class="text-muted mb-0"><i
                                        class="mdi mdi-clock-outline me-1"></i>{{ $pengumuman->formatted_date }}</p>
                            </div>
                            <h5 class="my-3">{{ $pengumuman->judul }}</h5>
                            <div id="show_isi">
                                {!! $pengumuman->isi !!}
                            </div>
                            </p>
                        </div>

                        <!-- comment start -->
                        <h5 class="border-bottom pb-3 mt-5">Comments</h5>
                        <div class="ps-0 pt-3 mt-3">
                            <div class="d-sm-flex align-items-top">
                                <div class="flex-shrink-0">
                                    <img class="rounded-circle avatar-md img-thumbnail"
                                        src="{{ asset('frontend-assets/images/users/img6.jpg') }}" alt="img" />
                                </div>
                                <div class="flex-grow-1 ms-sm-3">
                                    <small class="float-end fs-14">30 min Ago</small>
                                    <h6 class="mt-sm-0 mt-3 mb-0">Michelle Durant</h6>
                                    <p class="text-muted fs-14 mb-0">Jun 23, 2021</p>
                                    <div class="my-3 badge bg-light">
                                        <a href="javascript: void(0);" class="text-primary"><i class="mdi mdi-reply"></i>
                                            Reply</a>
                                    </div>
                                    <p class="text-muted fst-italic">" There are many variations of passages of Lorem Ipsum
                                        available, but the majority have suffered alteration in some form, by injected
                                        humour "</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-0 pt-3 mt-4">
                            <div class="d-sm-flex align-items-top">
                                <div class="flex-shrink-0">
                                    <img class="rounded-circle avatar-md img-thumbnail"
                                        src="{{ asset('frontend-assets/images/users/img8.jpg') }}" alt="img" />
                                </div>
                                <div class="flex-grow-1 ms-sm-3">
                                    <small class="float-end fs-14">2 hrs Ago</small>
                                    <h6 class="mt-sm-0 mt-3 mb-0">Steven Billups</h6>
                                    <p class="text-muted fs-14 mb-0">Jun 24, 2021</p>
                                    <div class="my-3 badge bg-light">
                                        <a href="javascript: void(0);" class="text-primary"><i class="mdi mdi-reply"></i>
                                            Reply</a>
                                    </div>
                                    <p class="text-muted fst-italic">" The most important aspect of beauty was, therefore,
                                        an inherent part of an object, rather than something applied superficially, and was
                                        based on universal, recognisable truths. "</p>

                                    <div class="d-sm-flex align-items-top mt-4">
                                        <div class="flex-shrink-0">
                                            <img class="rounded-circle avatar-md img-thumbnail"
                                                src="{{ asset('frontend-assets/images/users/img5.jpg') }}" alt="img" />
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3">
                                            <small class="float-end fs-14">2 hrs Ago</small>
                                            <h6 class="mt-sm-0 mt-3 mb-0">Harriet Townsend</h6>
                                            <p class="text-muted fs-14 mb-0">Jun 26, 2021</p>
                                            <div class="my-3 badge bg-light">
                                                <a href="javascript: void(0);" class="text-primary"><i
                                                        class="mdi mdi-reply"></i> Reply</a>
                                            </div>
                                            <p class="text-muted fst-italic">" This response is important for our ability to
                                                learn from mistakes, but it alsogives rise to self-criticism, because it is
                                                part of the threat-protection system. "</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end comment -->

                        <h6 class="border-bottom pb-3 mt-5">Berikan Komentar</h6>
                        <form action="#" class="contact-form mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text align-items-start"><i
                                                class="mdi mdi-comment-text-outline"></i></span>
                                        <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Masukkan komentar"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-end">
                                    <button name="submit" type="submit" id="submit" class="btn btn-primary">Kirim <i
                                            class="mdi mdi-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                        <!--end form-->

                        <ul class="list-inline mt-5 border-bottom mb-4">
                            <li class="list-inline-item">
                                <h6 class="text-uppercase me-2">Share :</h6>
                            </li>
                            <li class="list-inline-item border-end pe-3"><a href="javascript:void(0)"
                                    class="primary-link">Facebook</a></li>
                            <li class="list-inline-item border-end pe-3"><a href="javascript:void(0)"
                                    class="primary-link">Twitter</a></li>
                            <li class="list-inline-item border-end pe-3"><a href="javascript:void(0)"
                                    class="primary-link">Linked In</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="primary-link">Instagram</a>
                            </li>
                        </ul>
                    </article>
                    <!-- Post end-->
                </div><!--end col-->

                <div class="col-lg-4">
                    <div class="sidebar ms-lg-4 ps-lg-4">
                        <!-- Search widget-->
                        <aside class="widget widget_search">
                            <form class="position-relative">
                                <input class="form-control" type="search" placeholder="Search...">
                                <button
                                    class="bg-transparent border-0 position-absolute top-50 end-0 translate-middle-y me-2"
                                    type="submit"><span class="mdi mdi-magnify"></span></button>
                            </form>
                        </aside>

                        <div class="mt-4">
                            <div class="sd-title mt-4">
                                <h6 class="border-bottom pb-3 mb-0">Archives</h6>
                            </div>
                            <ul class="list-unstyled my-3">
                                <li class="py-1 text-dark"><a class="me-2 text-muted" href="javascript:void(0)">March
                                        2021</a> (40)
                                </li>
                                <li class="py-1 text-dark"><a class="me-2 text-muted" href="javascript:void(0)">April
                                        2021</a> (08)
                                </li>
                                <li class="py-1 text-dark"><a class="me-2 text-muted" href="javascript:void(0)">May
                                        2021</a> (11)</li>
                                <li class="py-1 text-dark"><a class="me-2 text-muted" href="javascript:void(0)">Jun
                                        2021</a> (21)</li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            <div class="sd-title mt-4">
                                <h6 class="border-bottom pb-3 mb-0">Tags</h6>
                            </div>
                            <div class="tagcloud py-4">
                                <a class="rounded d-inline-block fs-13 m-1 px-2 py-1" href="javascript:void(0)">logo</a>
                                <a class="rounded d-inline-block fs-13 m-1 px-2 py-1"
                                    href="javascript:void(0)">business</a>
                                <a class="rounded d-inline-block fs-13 m-1 px-2 py-1"
                                    href="javascript:void(0)">corporate</a>
                                <a class="rounded d-inline-block fs-13 m-1 px-2 py-1"
                                    href="javascript:void(0)">e-commerce</a>
                                <a class="rounded d-inline-block fs-13 m-1 px-2 py-1" href="javascript:void(0)">agency</a>
                                <a class="rounded d-inline-block fs-13 m-1 px-2 py-1"
                                    href="javascript:void(0)">responsive</a>
                            </div>
                        </div>
                    </div>
                    <!--end sidebar-->
                </div>
                <!-- end col-->
            </div>
        </div>
        <!-- end row -->
    </section>
@endsection

@push('customStyles')
    <style>
        #show_isi img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endpush
