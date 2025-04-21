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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Data
                        Kuliah <span id="alumni-nama"></span>
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
                        <li class="breadcrumb-item text-muted">Kuliah</li>
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
                                <input type="text" id="kuliah_search" data-kt-kuliah-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Cari kuliah" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-kuliah-table-toolbar="base">
                                <!--begin::Add kuliah-->
                                @can('kuliah.create')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_kuliah">
                                        <i class="ki-duotone ki-plus fs-2"></i> Tambah Kuliah
                                    </button>
                                @endcan
                                <!--end::Add kuliah-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div id="kuliah_table">
                            @include('backend.kuliah.table')
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
    @can('kuliah.create')
        @include('backend.kuliah.create')
    @endcan
    @can('kuliah.edit')
        @include('backend.kuliah.edit')
    @endcan
@endsection

@push('customScripts')
    <script>
        $(document).ready(function() {

            // ============================ Start Load data form ==============================
            function loadRoles(selector, selectedRoleId = null) {
                $.ajax({
                    url: '{{ route('role.data') }}',
                    type: 'GET',
                    success: function(data) {
                        let roleSelect = $(selector);
                        roleSelect.empty();
                        roleSelect.append('<option value="">Select Role</option>');
                        $.each(data, function(index, role) {
                            roleSelect.append('<option value="' + role.id + '">' + role.name +
                                '</option>');
                        });
                        if (selectedRoleId) {
                            roleSelect.val(selectedRoleId).trigger('change');
                        }
                    }
                });
            }

            $('#kt_modal_add_kuliah').on('show.bs.modal', function() {
                loadRoles('#role');
            });

            loadKuliahData();
            // ============================ End Load data form ==============================

            // ============================ Start DataTable ==============================
            // var table = $('#kt_table_kuliahs').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     order: [
            //         [4, 'desc']
            //     ],
            //     ajax: '{{ route('kuliah.index', ':id') }}'.replace(':id', id),
            //     columns: [{
            //             data: 'iteration',
            //             name: 'iteration',
            //             orderable: false,
            //             searchable: false
            //         },
            //         {
            //             data: 'jenjang',
            //             name: 'jenjang'
            //         },
            //         {
            //             data: 'jalur_masuk',
            //             name: 'jalur_masuk'
            //         },
            //         {
            //             data: 'tahun_masuk',
            //             name: 'tahun_masuk'
            //         },
            //         {
            //             data: 'tahun_lulus',
            //             name: 'tahun_lulus'
            //         },
            //         {
            //             data: 'created_at',
            //             name: 'created_at'
            //         },
            //         {
            //             data: 'updated_at',
            //             name: 'updated_at'
            //         },
            //         {
            //             data: 'actions',
            //             name: 'actions',
            //             orderable: false,
            //             searchable: false
            //         }
            //     ]
            // });

            // $('#kuliah_search').on('keyup', function() {
            //     table.search(this.value).draw();
            // });

            function loadKuliahData() {
                var alumniId = {{ $alumnus }};
                $.ajax({
                    url: '{{ route('kuliah.data', ':id') }}'.replace(':id', alumniId),
                    method: 'GET',
                    success: function(data) {
                        var tableBody = $('#kt_table_kuliahs tbody');
                        tableBody.empty(); // Clear existing data

                        moment.locale('id');

                        if (Array.isArray(data)) {
                            data.forEach(function(kuliah, index) {
                                tableBody.append(
                                    '<tr>' +
                                    '<td>' + (index + 1) +
                                    '</td>' +
                                    '<td>' + kuliah
                                    .nama_universitas +
                                    '</td>' +
                                    '<td>' + kuliah.jenjang +
                                    '</td>' +
                                    '<td>' + kuliah
                                    .jalur_masuk +
                                    '</td>' +
                                    '<td>' + kuliah
                                    .tahun_masuk +
                                    '</td>' +
                                    '<td>' + kuliah
                                    .tahun_lulus +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    '<button class="btn btn-warning btn-sm me-2 edit-button" data-id="' +
                                    kuliah
                                    .id + '">Ubah</button>' + // Add edit button
                                    '<button class="btn btn-danger btn-sm delete-button" data-id="' +
                                    kuliah
                                    .id + '">Hapus</button>' + // Add delete button
                                    '</td>' +
                                    '</tr>'
                                );
                            });
                        } else {
                            console.log("Data yang diterima bukan array", data);
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memuat data kuliah.');
                    }
                });
            };
            // ============================ End DataTable ==============================

            // ============================ Start Reset Form ==============================
            function resetForm(form) {
                $(form)[0].reset();
                $(form).find('input[name="id_kuliah"]').val('');
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
                        $('#kt_modal_add_kuliah').modal('hide');
                        resetForm('#kt_modal_add_kuliah_form');
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================

            // ============================ Start Tambah Kuliah ==============================
            $('#kt_modal_add_kuliah_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = {{ $alumnus }};
                var url = '{{ route('kuliah.store', ':id') }}'.replace(':id', alumniId);
                let form = $(this);
                var formData = new FormData(this);
                formData.append('alumni_id', alumniId);

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
                                $('#kt_modal_add_kuliah').modal('hide');
                                loadKuliahData();
                                resetForm('#kt_modal_add_kuliah_form');
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
            // ============================ End Tambah Kuliah ==============================

            // ============================ Start Show Modal Edit ==============================
            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                var alumniId = {{ $alumnus }};
                var editUrl = '{{ route('kuliah.edit', [':alumni_id', ':id']) }}'
                    .replace(':alumni_id', alumniId)
                    .replace(':id', id);

                console.log(editUrl);

                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    success: function(response) {
                        console.log(response);
                        $('#edit_id_kuliah').val(response.id);
                        $('#edit_alumni_id').val(alumniId);
                        $('#edit_nama_universitas').val(response.nama_universitas);
                        $('#edit_jenjang').val(response.jenjang);
                        $('#edit_jalur_masuk').val(response.jalur_masuk);
                        $('#edit_tahun_masuk').val(response.tahun_masuk);
                        $('#edit_tahun_lulus').val(response.tahun_lulus);
                        $('#kt_modal_edit_kuliah_form').attr('action',
                            '{{ route('kuliah.update', [':alumni_id', ':id']) }}'
                            .replace(':alumni_id', alumniId)
                            .replace(':id', response.id));
                        $('#kt_modal_edit_kuliah').modal('show');
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
                        $('#kt_modal_edit_kuliah').modal('hide');
                        resetForm('#kt_modal_edit_kuliah_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Edit Kuliah ==============================
            $('#kt_modal_edit_kuliah_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = {{ $alumnus }};
                var id = $('#edit_id_kuliah').val();
                var url = '{{ route('kuliah.update', [':alumni_id', ':id']) }}'
                    .replace(':alumni_id', alumniId)
                    .replace(':id', id);
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
                                $('#kt_modal_edit_kuliah').modal('hide');
                                loadKuliahData();
                                resetForm('#kt_modal_edit_kuliah_form');
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
            // ============================ End Edit Kuliah ==============================

            // ============================ Start Delete Kuliah ==============================
            $(document).on('click', '.delete-button', function() {
                var alumniId = {{ $alumnus }};
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
                            url: '{{ route('kuliah.destroy', [':alumni_id', ':id']) }}'
                                .replace(':alumni_id', alumniId).replace(':id', id),
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message
                                });
                                loadKuliahData();
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
            // ============================ End Delete Kuliah ==============================
        });
    </script>
@endpush
