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
                <div class="col-lg-12">
                    <div class="card-body py-4">
                        <div id="data_alumni_table">
                            <table id="table_data_alumnis" class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-start">Nama</th>
                                        <th class="text-start">Kelas</th>
                                        <th class="text-start">Tahun Lulus</th>
                                        <th class="text-start">Instagram</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTables will populate this tbody -->
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
                ajax: '{{ route('landing.dataAlumni') }}',
                columns: [{
                        class: 'text-start',
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        class: 'text-start',
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        class: 'text-start',
                        data: 'tahun_lulus',
                        name: 'tahun_lulus'
                    },
                    {
                        class: 'text-start',
                        data: 'instagram',
                        name: 'instagram'
                    },
                ],
                lengthChange: false,
                pageLength: 30,
                layout: {
                    // topStart: function() {
                    //     let cardViewButton =
                    //         '<button class="btn btn-primary" id="cardViewButton">Card View</button>';
                    //     return cardViewButton;
                    // },
                    topStart: {
                        buttons: [{
                            text: 'Card View',
                            className: 'btn btn-primary',
                            attr: {
                                id: 'cardViewButton'
                            },
                            action: function(e, dt, node, config) {
                                if ($("#table_data_alumnis").hasClass("card")) {
                                    $("#cardViewButton").text("Card View");
                                    $(".colHeader").remove();
                                } else {
                                    $("#cardViewButton").text("Table View");
                                    var labels = [];
                                    $("#table_data_alumnis thead th").each(function() {
                                        labels.push($(this).text());
                                    });
                                    $("#table_data_alumnis tbody tr").each(function() {
                                        $(this)
                                            .find("td")
                                            .each(function(column) {
                                                $("<span class='colHeader'>" +
                                                        labels[column] + ":</span>")
                                                    .prependTo(
                                                        $(this)
                                                    );
                                            });
                                    });
                                }
                                $("#table_data_alumnis").toggleClass("card");
                            }
                        }]
                    },
                },
            });

            $('#table_data_alumnis').on('click', '#cardViewButton', function() {
                console.log('Card View Button Clicked');
            });
        });
    </script>
@endpush

@push('customStyles')
    <style>
        #alumni {
            display: grid;
            grid-template-rows: auto 1fr auto;
            grid-template-columns: 100%;

            /* fallback height */
            min-height: 100vh;

            /* new small viewport height for modern browsers */
            min-height: 100svh;
        }

        #table_data_alumnis th {
            background-color: #008cff;
            color: white;
        }

        .form-control#dt-search-0 {
            padding: 6px 10px;
        }

        .btn#cardViewButton {
            max-height: 40px;
            display: flex;
            align-items: center;
        }

        .table-bordered.card {
            border: 0 !important;
        }

        .card thead {
            display: none;
        }

        .card tbody tr {
            float: left;
            width: 23.75em;
            margin: 0.5em;
            border: 1px solid #bfbfbf;
        }

        .card tbody tr td {
            display: block;
            border: 0;
        }
    </style>
@endpush

{{-- <td>
                                        <img src="{{ asset('frontend-assets/images/home/messi.png') }}"
                                            alt="Alumni Photo" class="img-fluid rounded"
                                            style="height: 150px;">
                                    </td> --}}
