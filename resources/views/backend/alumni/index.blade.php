@extends('backend.parts.master')
@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Alumni
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Alumni</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" id="alumni_search" data-kt-alumni-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Cari alumni" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-alumni-table-toolbar="base">
                                <!--begin::Add alumni-->
                                @can('alumni.create')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_alumni">
                                        <i class="ki-duotone ki-plus fs-2"></i> Tambah Alumni
                                    </button>
                                @endcan
                                <!--end::Add alumni-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div id="alumni_table">
                            @include('backend.alumni.table')
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    @can('alumni.create')
        @include('backend.alumni.create')
    @endcan
    @can('alumni.edit')
        @include('backend.alumni.edit')
    @endcan
@endsection

@push('customScripts')
    <script>
        $(document).ready(function() {

            // ============================ Start Load data form ==============================
            function loadUsers(selector, selectedUserId = null) {
                $.ajax({
                    url: '{{ route('user.data') }}',
                    type: 'GET',
                    success: function(data) {
                        let userSelect = $(selector);
                        userSelect.empty();
                        userSelect.append('<option value="">Select User</option>');
                        $.each(data, function(index, user) {
                            userSelect.append('<option value="' + user.id + '">' + user.name +
                                '</option>');
                        });
                        if (selectedUserId) {
                            userSelect.val(selectedUserId).trigger('change');
                        }
                    }
                });
            }

            $('#kt_modal_add_alumni').on('show.bs.modal', function() {
                loadUsers('#id_user');
            });
            // ============================ End Load data form ==============================

            // ============================ Start Action Button  ==============================
            $(document).on('click', '.pad-button', function() {
                var alumniId = $(this).data('id');
                window.location.href = '{{ route('pad.index', ':id') }}'.replace(':id', alumniId);
            });
            // ============================ End Action Button ==============================

            // ============================ Start DataTable ==============================
            var table = $('#kt_table_alumnis').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [4, 'desc']
                ],
                ajax: '{{ route('alumni.index') }}',
                columns: [{
                        data: 'iteration',
                        name: 'iteration',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir'
                    },
                    {
                        data: 'tahun_masuk',
                        name: 'tahun_masuk'
                    },
                    {
                        data: 'tahun_lulus',
                        name: 'tahun_lulus'
                    },
                    {
                        data: 'instagram',
                        name: 'instagram'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#alumni_search').on('keyup', function() {
                table.search(this.value).draw();
            });
            // ============================ End DataTable ==============================

            // ============================ Start Datepicker ==============================
            $(document).ready(function() {
                function initializeDatepicker(elementId) {
                    $("#" + elementId).val('');
                    $("#" + elementId).daterangepicker({
                            singleDatePicker: true,
                            showDropdowns: true,
                            parentEl: '#kt_modal_app_alumni',
                            minYear: 1901,
                            maxYear: parseInt(moment().format("YYYY"), 12),
                            autoUpdateInput: false
                        },
                        function(start, end, label) {
                            if (start) {
                                var years = moment().diff(start, "years");
                                $("#" + elementId).val(start.format('YYYY/MM/DD'));
                            }
                        });
                }
                initializeDatepicker("tanggal_lahir");
            });
            // ============================ End Datepicker ==============================

            // ============================ Start Reset Form ==============================
            function resetForm(form) {
                $(form)[0].reset();
                $(form).find('input[name="id_alumni"]').val('');
                $(form).find('select').val('').trigger('change');
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();
            }

            function clearValidationErrors(form) {
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.text-danger').remove();
            }
            // ============================ End Reset Form ==============================


            // ============================ Start Action Cancel Add ==============================
            $('#cancel_button, #close_modal_button').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Datanya akan hilang!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak, tetap di sini!',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#kt_modal_add_alumni').modal('hide');
                        resetForm('#kt_modal_add_alumni_form');
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================


            // ============================ Start Tambah Alumni ==============================
            $('#kt_modal_add_alumni_form').on('submit', function(e) {
                e.preventDefault();
                var url = '{{ route('alumni.store') }}';
                let form = $(this);
                var formData = new FormData(this);

                clearValidationErrors(form);

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data akan disimpan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Tidak, batalkan!',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message
                                });
                                $('#kt_modal_add_alumni').modal('hide');
                                table.ajax.reload();
                                resetForm('#kt_modal_add_alumni_form');
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    var errors = xhr.responseJSON.errors;
                                    $('.text-danger').remove();

                                    $.each(errors, function(key, value) {
                                        var element = form.find('[name="' +
                                            key + '"]');
                                        element.addClass('is-invalid');

                                        if (element.is('select')) {
                                            element.next().after(
                                                '<div class="text-danger">' +
                                                value[0] + '</div>');
                                        } else {
                                            element.after(
                                                '<div class="text-danger">' +
                                                value[0] + '</div>');
                                        }
                                    });

                                    var errorMessage = '';
                                    $.each(errors, function(key, value) {
                                        errorMessage += value[0] + '<br>';
                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Validation Error!',
                                        html: errorMessage
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Eror saat menyimpan data.'
                                    });
                                }
                            }
                        });
                    }
                });
            });
            // ============================ End Tambah Alumni ==============================

            // ============================ Start Show Modal Edit ==============================
            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                var editUrl = '{{ route('alumni.edit', ':id') }}'.replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    success: function(response) {
                        console.log(response);
                        $('#edit_id_alumni').val(response.id);
                        $('#edit_nis').val(response.nis);
                        $('#edit_nama').val(response.nama);
                        $('#edit_kelas').val(response.kelas);
                        $('#edit_tahun_masuk').val(response.tahun_masuk);
                        $('#edit_tahun_lulus').val(response.tahun_lulus);
                        $('#edit_instagram').val(response.instagram);
                        $('#edit_sosmed_lain').val(response.sosmed_lain);
                        loadUsers('#edit_id_user', response.id_user);

                        function initializeDatepickerEdit(elementId, response) {
                            var dateValue = response[elementId];
                            if (dateValue) {
                                var formattedDate = moment(dateValue, 'YYYY-MM-DD').format(
                                    'MM/DD/YYYY');
                                $("#edit_" + elementId).val(formattedDate);
                            }

                            $("#edit_" + elementId).daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                                parentEl: '#kt_modal_edit_alumni',
                                minYear: 1901,
                                maxYear: parseInt(moment().format("YYYY"), 12),
                                autoUpdateInput: false
                            }, function(start, end, label) {
                                if (start) {
                                    $("#edit_" + elementId).val(start.format(
                                        'MM/DD/YYYY'));
                                }
                            });
                        }

                        initializeDatepickerEdit("tanggal_lahir", response);

                        $('#kt_modal_edit_alumni_form').attr('action',
                            '{{ route('alumni.update', ':id') }}'.replace(':id', response
                                .id));
                        $('#kt_modal_edit_alumni').modal('show');
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON.message
                        });
                    }
                });
            });
            // ============================ End Show Modal Edit ==============================

            // ============================ Start Cancel Edit ==============================
            $('#cancel_edit_button, #close_modal_edit_button').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Datanya akan hilang!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak, tetap di sini!',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#kt_modal_edit_alumni').modal('hide');
                        resetForm('#kt_modal_edit_alumni_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Edit Alumni ==============================
            $('#kt_modal_edit_alumni_form').on('submit', function(e) {
                e.preventDefault();
                var id_alumni = $('#edit_id_alumni').val();
                var url = '{{ route('alumni.update', ':id') }}'.replace(':id', id_alumni);
                let form = $(this);
                var formData = new FormData(this);

                clearValidationErrors(form);

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data akan disimpan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Tidak, batalkan!',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message
                                });
                                $('#kt_modal_edit_alumni').modal('hide');
                                table.ajax.reload();
                                resetForm('#kt_modal_edit_alumni_form');
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    var errors = xhr.responseJSON.errors;
                                    $('.text-danger').remove();

                                    $.each(errors, function(key, value) {
                                        var element = form.find('[name="' +
                                            key + '"]');
                                        element.addClass('is-invalid');

                                        if (element.is('select')) {
                                            element.next().after(
                                                '<div class="text-danger">' +
                                                value[0] + '</div>');
                                        } else {
                                            element.after(
                                                '<div class="text-danger">' +
                                                value[0] + '</div>');
                                        }
                                    });

                                    var errorMessage = '';
                                    $.each(errors, function(key, value) {
                                        errorMessage += value[0] + '<br>';
                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Validation Error!',
                                        html: errorMessage
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Error terjadi saat menyimpan data.'
                                    });
                                }
                            }
                        });
                    }
                });
            });
            // ============================ End Edit Alumni ==============================

            // ============================ Start Delete Alumni ==============================
            $(document).on('click', '.delete-button', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Tidak, batalkan!',
                    customClass: {
                        confirmButton: "btn btn-danger",
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ route('alumni.destroy', ':id') }}'.replace(':id', id),
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message
                                });
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Error terjadi saat menghapus data.'
                                });
                            }
                        });
                    }
                });
            });
            // ============================ End Delete Alumni ==============================
        });
    </script>
@endpush
