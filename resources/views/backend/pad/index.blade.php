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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Post
                        Academic Data
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('alumni.index') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Data Alumni {{ $alumni->nama }}</li>
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
                            <h3 class="fw-bold m-0">Data Alumni {{ $alumni->nama }}</h3>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-alumni-table-toolbar="base">
                                <!--begin::Add alumni-->
                                @can('kuliah.create')
                                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_kuliah">
                                        <i class="ki-duotone ki-plus fs-2"></i> Tambah Kuliah
                                    </button>
                                @endcan
                                @can('kerja.create')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_kerja">
                                        <i class="ki-duotone ki-plus fs-2"></i> Tambah Kerja
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
                        <!-- begin::Main content -->
                        <div class="row justify-content-center align-items-start">
                            <div class="col-md-3 d-flex flex-column align-items-center pb-5">
                                <img src="{{ asset('frontend-assets/images/home/messi.png') }}" alt="Alumni Photo"
                                    class="img-fluid rounded shadow" style="max-height: 150px;">
                            </div>
                            <div class="col-md-9">
                                <div id="pad">
                                    <div class="mb-3">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">
                                                    <i class="fas fa-user-graduate me-2 text-primary"></i>Profil Alumni
                                                </h5>
                                                <div class="row">
                                                    <!-- Left Column -->
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div
                                                                class="flex-shrink-0 bg-light-primary rounded-circle p-2 me-3">
                                                                <i class="fas fa-user text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-muted small">Nama Lengkap</h6>
                                                                <p class="mb-0 fw-bold">{{ $alumni->nama }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <div
                                                                class="flex-shrink-0 bg-light-primary rounded-circle p-2 me-3">
                                                                <i class="fas fa-id-card text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-muted small">NIS</h6>
                                                                <p class="mb-0 fw-bold">{{ $alumni->nis }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <div
                                                                class="flex-shrink-0 bg-light-primary rounded-circle p-2 me-3">
                                                                <i class="fas fa-school text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-muted small">Kelas</h6>
                                                                <p class="mb-0 fw-bold">{{ $alumni->kelas }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <div
                                                                class="flex-shrink-0 bg-light-primary rounded-circle p-2 me-3">
                                                                <i class="fas fa-calendar text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-muted small">Tahun Masuk</h6>
                                                                <p class="mb-0 fw-bold">{{ $alumni->tahun_masuk }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Right Column -->
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div
                                                                class="flex-shrink-0 bg-light-primary rounded-circle p-2 me-3">
                                                                <i class="fas fa-calendar text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-muted small">Tahun Lulus</h6>
                                                                <p class="mb-0 fw-bold">{{ $alumni->tahun_lulus }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <div
                                                                class="flex-shrink-0 bg-light-primary rounded-circle p-2 me-3">
                                                                <i class="fas fa-birthday-cake text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-muted small">Tanggal Lahir</h6>
                                                                <p class="mb-0 fw-bold">{{ $alumni->tanggal_lahir }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <div
                                                                class="flex-shrink-0 bg-light-primary rounded-circle p-2 me-3">
                                                                <i class="fab fa-instagram text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-muted small">Instagram</h6>
                                                                <p class="mb-0 fw-bold">
                                                                    @if ($alumni->instagram)
                                                                        <a href="https://instagram.com/{{ $alumni->instagram }}"
                                                                            target="_blank" class="text-decoration-none">
                                                                            {{ $alumni->instagram }}
                                                                        </a>
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <!-- begin::Data Kuliah -->
                                    <div class="d-flex justify-content-between">
                                        <span style="font-size: 1.5rem;">
                                            <h5>Data Kuliah</h5>
                                        </span>
                                    </div>
                                    <!--begin::Table-->
                                    @if ($alumni->kuliah->count() > 0)
                                        <div id="kuliah_table">
                                            @include('backend.kuliah.table')
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada data kuliah yang terdata.</p>
                                    @endif
                                    <!--end::Table-->
                                    <!-- end::Data Kuliah -->
                                    <br />
                                    <!-- begin::Data Kerja -->
                                    <div class="d-flex justify-content-between">
                                        <span style="font-size: 1.5rem;">
                                            <h5>Data Kerja</h5>
                                        </span>
                                    </div>
                                    <!--begin::Table-->
                                    @if ($alumni->kerja->count() > 0)
                                        <div id="kerja_table">
                                            @include('backend.kerja.table')
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada data kerja yang terdata.</p>
                                    @endif
                                    <!--end::Table-->
                                    <!-- end::Data Kerja -->
                                </div>
                            </div>
                        </div>
                        <!-- end::Main content -->
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
    @include('backend.kuliah.show')
    @can('kerja.create')
        @include('backend.kerja.create')
    @endcan
    @can('kerja.edit')
        @include('backend.kerja.edit')
    @endcan
@endsection

@push('customScripts')
    <script>
        $(document).ready(function() {
            // ============================ Start Reset Form ==============================
            function resetFormKuliah(form) {
                $(form)[0].reset();
                $(form).find('input[name="id_kuliah"]').val('');
                $(form).find('select').val('').trigger('change');
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();
            }

            function resetFormKerja(form) {
                $(form)[0].reset();
                $(form).find('input[name="id_kerja"]').val('');
                $(form).find('select').val('').trigger('change');
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();
            }

            function clearValidationErrors(form) {
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.text-danger').remove();
            }
            // ============================ End Reset Form ==============================

            // ============================ Start Data Kuliah ==============================
            loadKuliahData();

            function loadKuliahData() {
                var alumniId = '{{ $alumni->id }}';
                $.ajax({
                    url: '{{ route('pad.kuliah', ':id') }}'.replace(':id', alumniId),
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
                                    '<td>' + kuliah.fakultas +
                                    '</td>' +
                                    '<td>' + kuliah.status_kuliah +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    '<button class="btn btn-info btn-sm me-2 show-button-kuliah" data-id="' +
                                    kuliah
                                    .id + '">Detail</button>' + // Add detail button
                                    '<button class="btn btn-warning btn-sm me-2 edit-button-kuliah" data-id="' +
                                    kuliah
                                    .id + '">Ubah</button>' + // Add edit button
                                    '<button class="btn btn-danger btn-sm delete-button-kuliah" data-id="' +
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
            // ============================ End Data Kuliah ==============================

            // ============================ Start Action Cancel Add ==============================
            $('#cancel_button_kuliah, #close_modal_button_kuliah').on('click', function(e) {
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
                        resetFormKuliah('#kt_modal_add_kuliah_form');
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================

            // ============================ Start Tambah Kuliah ==============================
            $('#kt_modal_add_kuliah_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = '{{ $alumni->id }}';
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
                                }).then(function() {
                                    window.location.reload();
                                });
                                $('#kt_modal_add_kuliah').modal('hide');
                                resetFormKuliah('#kt_modal_add_kuliah_form');
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

            // ============================ Start Show Modal Detail ==============================
            $(document).on('click', '.show-button-kuliah', function() {
                var id = $(this).data('id');
                var alumniId = '{{ $alumni->id }}';
                var showUrl = '{{ route('kuliah.show', [':alumni_id', ':id']) }}'
                    .replace(':alumni_id', alumniId)
                    .replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: showUrl,
                    success: function(response) {
                        $('#show_nama_universitas').val(response.nama_universitas);
                        $('#show_jenjang').val(response.jenjang);
                        $('#show_fakultas').val(response.fakultas);
                        $('#show_program_studi').val(response.program_studi);
                        $('#show_status_kuliah').val(response.status_kuliah);
                        $('#show_jalur_masuk').val(response.jalur_masuk);
                        $('#show_tahun_masuk_kuliah').val(response.tahun_masuk);
                        $('#show_tahun_lulus_kuliah').val(response.tahun_lulus);
                        $('#kt_modal_show_kuliah').modal('show');
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
            // ============================ End Show Modal Detail ==============================

            // ============================ Start Close Detail Kuliah ==============================
            $('#cancel_show_button_kuliah, #close_modal_show_button_kuliah').on('click', function(e) {
                e.preventDefault();
                $('#kt_modal_show_kuliah').modal('hide');
                resetFormKuliah('#kt_modal_show_kuliah_form');
            });
            // ============================ End Close Detail Kuliah ==============================

            // ============================ Start Show Modal Edit ==============================
            $(document).on('click', '.edit-button-kuliah', function() {
                var id = $(this).data('id');
                var alumniId = '{{ $alumni->id }}';
                var editUrl = '{{ route('kuliah.edit', [':alumni_id', ':id']) }}'
                    .replace(':alumni_id', alumniId)
                    .replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    success: function(response) {
                        console.log(response);
                        $('#edit_id_kuliah').val(response.id);
                        $('#edit_alumni_id').val(alumniId);
                        $('#edit_nama_universitas').val(response.nama_universitas);
                        $('#edit_jenjang').val(response.jenjang);
                        $('#edit_fakultas').val(response.fakultas);
                        $('#edit_program_studi').val(response.program_studi);
                        $('#edit_status_kuliah').trigger('change').val(response.status_kuliah)
                            .trigger('change');
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
            $('#cancel_edit_button_kuliah, #close_modal_edit_button_kuliah').on('click', function(e) {
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
                        resetFormKuliah('#kt_modal_edit_kuliah_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Edit Kuliah ==============================
            $('#kt_modal_edit_kuliah_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = '{{ $alumni->id }}';
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
                                resetFormKuliah('#kt_modal_edit_kuliah_form');
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
            $(document).on('click', '.delete-button-kuliah', function() {
                var alumniId = '{{ $alumni->id }}';
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
                                }).then(function() {
                                    window.location.reload();
                                });
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

            // ============================ Start Data Kerja ==============================
            loadKerjaData();

            function loadKerjaData() {
                var alumniId = '{{ $alumni->id }}';
                $.ajax({
                    url: '{{ route('pad.kerja', ':id') }}'.replace(':id', alumniId),
                    method: 'GET',
                    success: function(data) {
                        var tableBody = $('#kt_table_kerjas tbody');
                        tableBody.empty(); // Clear existing data

                        moment.locale('id');

                        if (Array.isArray(data)) {
                            data.forEach(function(kerja, index) {
                                tableBody.append(
                                    '<tr>' +
                                    '<td>' + (index + 1) +
                                    '</td>' +
                                    '<td>' + kerja.tempat_kerja +
                                    '</td>' +
                                    '<td>' + kerja
                                    .posisi_kerja +
                                    '</td>' +
                                    '<td>' + kerja.alamat_kerja + '</td>' +
                                    '<td>' + kerja
                                    .tahun_masuk +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    '<button class="btn btn-warning btn-sm me-2 edit-button-kerja" data-id="' +
                                    kerja
                                    .id + '">Ubah</button>' + // Add edit button
                                    '<button class="btn btn-danger btn-sm delete-button-kerja" data-id="' +
                                    kerja
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
                        alert('Terjadi kesalahan saat memuat data kerja.');
                    }
                });
            };
            // ============================ End Data Kerja ==============================

            // ============================ Start Action Cancel Add ==============================
            $('#cancel_button_kerja, #close_modal_button_kerja').on('click', function(e) {
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
                        $('#kt_modal_add_kerja').modal('hide');
                        resetFormKerja('#kt_modal_add_kerja_form');
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================

            // ============================ Start Tambah Kerja ==============================
            $('#kt_modal_add_kerja_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = '{{ $alumni->id }}';
                var url = '{{ route('kerja.store', ':id') }}'.replace(':id', alumniId);
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
                                }).then(function() {
                                    window.location.reload();
                                });
                                $('#kt_modal_add_kerja').modal('hide');
                                resetFormKerja('#kt_modal_add_kerja_form');
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
            // ============================ End Tambah Kerja ==============================

            // ============================ Start Show Modal Edit ==============================
            $(document).on('click', '.edit-button-kerja', function() {
                var id = $(this).data('id');
                var alumniId = '{{ $alumni->id }}';
                var editUrl = '{{ route('kerja.edit', [':alumni_id', ':id']) }}'
                    .replace(':alumni_id', alumniId)
                    .replace(':id', id);

                console.log(editUrl);

                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    success: function(response) {
                        console.log(response);
                        $('#edit_id_kerja').val(response.id);
                        $('#edit_alumni_id').val(alumniId);
                        $('#edit_posisi_kerja').val(response.posisi_kerja);
                        $('#edit_tempat_kerja').val(response.tempat_kerja);
                        $('#edit_alamat_kerja').val(response.alamat_kerja);
                        $('#edit_tahun_masuk_kerja').val(response.tahun_masuk);
                        $('#kt_modal_edit_kerja_form').attr('action',
                            '{{ route('kerja.update', [':alumni_id', ':id']) }}'
                            .replace(':alumni_id', alumniId)
                            .replace(':id', response.id));
                        $('#kt_modal_edit_kerja').modal('show');
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
            $('#cancel_edit_button_kerja, #close_modal_edit_button_kerja').on('click', function(e) {
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
                        $('#kt_modal_edit_kerja').modal('hide');
                        resetFormKerja('#kt_modal_edit_kerja_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Edit Kerja ==============================
            $('#kt_modal_edit_kerja_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = '{{ $alumni->id }}';
                var id = $('#edit_id_kerja').val();
                var url = '{{ route('kerja.update', [':alumni_id', ':id']) }}'
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
                                $('#kt_modal_edit_kerja').modal('hide');
                                loadKerjaData();
                                resetFormKerja('#kt_modal_edit_kerja_form');
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
            // ============================ End Edit Kerja ==============================

            // ============================ Start Delete Kerja ==============================
            $(document).on('click', '.delete-button-kerja', function() {
                var alumniId = '{{ $alumni->id }}';
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
                            url: '{{ route('kerja.destroy', [':alumni_id', ':id']) }}'
                                .replace(':alumni_id', alumniId).replace(':id', id),
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message
                                }).then(function() {
                                    window.location.reload();
                                });
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
            // ============================ End Delete Kerja ==============================
        });
    </script>
@endpush
@push('customStyles')
    <style>
        .rounded-circle {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush
