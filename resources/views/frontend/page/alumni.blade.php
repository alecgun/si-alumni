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
                            <table id="table_data_alumnis" class="table table-bordered card" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-start">NIS</th>
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
                        data: 'nis',
                        name: 'nis'
                    },
                    {
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
                    topStart: {
                        buttons: [{
                            text: 'Table View',
                            className: 'btn btn-primary',
                            attr: {
                                id: 'viewSwitchButton'
                            },
                            action: function(e, dt, node, config) {
                                if ($("#table_data_alumnis").hasClass("card")) {
                                    $("#viewSwitchButton").text("Card View");
                                    $(".colHeader").remove();
                                } else {
                                    $("#viewSwitchButton").text("Table View");
                                    addCardLabels();
                                }
                                $("#table_data_alumnis").toggleClass("card");
                            }
                        }]
                    },
                },
                drawCallback: function(settings) {
                    if ($("#table_data_alumnis").hasClass("card")) {
                        addCardLabels();
                    }
                },
            });

            function addCardLabels() {
                var labels = [];
                $("#table_data_alumnis thead th").each(function() {
                    labels.push($(this).text());
                });
                $("#table_data_alumnis tbody tr").each(function() {
                    $(this).find("td").each(function(column) {
                        if (!$(this).find('.colHeader').length) {
                            $("<span class='colHeader'>" + labels[column] + ":</span>")
                                .prependTo($(this));
                        }
                    });
                });
            }


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

        #table_data_alumnis.card {
            background-color: transparent;
        }

        .form-control#dt-search-0 {
            padding: 6px 10px;
        }

        .btn#viewSwitchButton {
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

        .card tbody {
            display: inline-flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 10px;
            margin: 5px;
        }

        .card tbody tr {
            float: left;
            width: 24em;
            border: 0 !important;
            border-radius: 10px;
            box-shadow: 0 0px 4px rgba(0, 0, 0, 0.1);
        }

        .card tbody tr td {
            display: block;
            padding-inline: 1em;
            border: 0 !important;
            border-radius: 10px;
        }

        .card tbody tr td .colHeader {
            font-weight: bold;
            font-size: 14px;
            margin-right: 10px;
            color: #008cff;
            display: inline-table;
            width: 95px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            ...
        }

        /* Large phones (600px - 767px) */
        @media only screen and (max-width: 767px) {
            .btn#viewSwitchButton {
                display: none;
            }
        }

        /* Tablets (768px - 991px) */
        @media only screen and (max-width: 991px) {
            .card tbody {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin: 5px;
            }

            .card tbody tr {
                float: center;
                width: 24em;
                margin-block: 5px;
            }
        }
    </style>
@endpush

{{-- <td>
                                        <img src="{{ asset('frontend-assets/images/home/messi.png') }}"
                                            alt="Alumni Photo" class="img-fluid rounded"
                                            style="height: 150px;">
                                    </td> --}}
