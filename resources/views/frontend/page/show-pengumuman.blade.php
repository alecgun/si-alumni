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
                        <!-- end Post-->
                </div>
                <!--end col-->
                {{-- <div class="col-lg-4">
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
                <!-- end col--> --}}
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
