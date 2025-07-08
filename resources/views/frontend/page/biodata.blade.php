@extends('frontend.page.parts.master')
@section('content')
    <!-- START HERO -->
    <section class="bg-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white">
                        <h2 class="text-white fw-bold">Biodata Alumni</h2>
                        {{-- <nav aria-label="breadcrumb" class="mt-3">
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                                <li class="breadcrumb-item active text-white-50" aria-current="page">Biodata Alumni</li>
                            </ul>
                        </nav> --}}
                        <p class="text-white-50">Data kuliah dan data kerja yang diisi oleh alumni tidak akan ditampilkan di
                            halaman daftar alumni.</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END HERO -->
    <!-- START MAIN -->
    <section class="section bg-light" id="biodata">
        <div class="container">
            <div class="row justify-content-center align-items-start">
                <div class="col-md-4 text-center mb-3">
                    <img src="{{ auth()->user()->img_user ? asset('storage/' . auth()->user()->img_user) : asset('frontend-assets/images/users/placeholder.png') }}"
                        alt="Alumni Photo" class="rounded object-fit-cover" style="height: 150px; aspect-ratio: 4/6;">
                    <h5 class="mt-3">{{ auth()->user()->name }}</h5>
                    <button class="btn btn-primary mt-2 edit-button-password" data-bs-toggle="modal"
                        data-bs-target="#modal_edit_password">Ganti Password</button>
                </div>
                <div class="col-md-8 shadow-sm p-4" id="biodata-content">
                    <div id="data_pribadi">
                        <div class="d-flex justify-content-between mb-2">
                            <span>
                                <h5>Data Pribadi</h5>
                            </span>
                            <button type="button" class="btn btn-primary mdi mdi-pencil edit-button-sosmed fw-bold"
                                data-bs-toggle="modal" data-bs-target="#modal_edit_sosmed"> Edit Data Sosmed</button>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">NIS</span>
                            <span id="nis" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Nama Lengkap</span>
                            <span id="nama" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Kelas</span>
                            <span id="kelas" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Tanggal Lahir</span>
                            <span id="tanggal_lahir" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Jenis Kelamin</span>
                            <span id="jenis_kelamin" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Tahun Masuk</span>
                            <span id="tahun_masuk" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Tahun Lulus</span>
                            <span id="tahun_lulus" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Instagram</span>
                            <span id="instagram" class="fw-bold"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="me-2 text-muted">Sosmed Lain</span>
                            <span id="sosmed_lain" class="fw-bold"></span>
                        </div>
                    </div>
                    <br />
                    <div id="kuliah">
                        <div class="d-flex justify-content-between">
                            <span>
                                <h5>Data Kuliah</h5>
                            </span>
                            <button type="button" class="btn btn-primary mdi mdi-plus fw-bold" data-bs-toggle="modal"
                                data-bs-target="#modal_add_kuliah"> Tambah</button>
                        </div>
                        <div id="kuliah-list">
                            <!-- Data kuliah akan dimasukkan di sini -->
                        </div>
                    </div>
                    <div id="kerja">
                        <div class="d-flex justify-content-between">
                            <span>
                                <h5>Data Kerja</h5>
                            </span>
                            <button type="button" class="btn btn-primary mdi mdi-plus fw-bold" data-bs-toggle="modal"
                                data-bs-target="#modal_add_kerja"> Tambah</button>
                        </div>
                        <div id="kerja-list">
                            <!-- Data kerja akan dimasukkan di sini -->
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END MAIN -->
    @include('frontend.page.edit-password')
    @include('frontend.page.edit-alumni-sosmed')
    @include('frontend.page.create-kuliah')
    @include('frontend.page.edit-kuliah')
    @include('frontend.page.create-kerja')
    @include('frontend.page.edit-kerja')
@endsection

@push('customScripts')
    <script>
        $(document).ready(function() {
            // ============================ Start Reset Form ==============================
            function showValidationErrors(errors) {
                // errors contohnya: { "tanggal": ["The tanggal field is required."] }
                for (const fieldName in errors) {
                    if (Object.hasOwnProperty.call(errors, fieldName)) {
                        // Pesan error pertama
                        const errorMsg = errors[fieldName][0];

                        // Temukan field input
                        const inputField = $(`[name="${fieldName}"]`);
                        inputField.addClass('is-invalid');

                        // Jika belum ada .invalid-feedback, buat baru
                        if (inputField.next('.invalid-feedback').length === 0) {
                            inputField.after(`<div class="invalid-feedback">${errorMsg}</div>`);
                        }
                    }
                }
            }

            // Fungsi membersihkan error sebelumnya
            function clearErrorFeedback() {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            }

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

            function resetFormSosmed(form) {
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

            // ============================ Start Get Data Alumni ==============================
            getData();

            function getData() {
                $.ajax({
                    url: '{{ route('landing.getAlumniByAuthUser') }}', // pastikan ini rute yang benar
                    method: 'GET',
                    success: function(response) {
                        // Periksa jika data alumni ditemukan
                        if (response.alumni) {
                            // Update data pribadi
                            $('#nis').text(response.alumni.nis || '-');
                            $('#nama').text(response.alumni.nama || '-');
                            $('#kelas').text(response.alumni.kelas || '-');
                            $('#tanggal_lahir').text(response.alumni.tanggal_lahir ? new Date(response
                                .alumni
                                .tanggal_lahir).toLocaleDateString('id-ID', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            }) : '-');
                            $('#jenis_kelamin').text(response.alumni.jenis_kelamin || '-');
                            $('#tahun_masuk').text(response.alumni.tahun_masuk || '-');
                            $('#tahun_lulus').text(response.alumni.tahun_lulus || '-');
                            $('#instagram').text(response.alumni.instagram || '-');
                            $('#sosmed_lain').text(response.alumni.sosmed_lain || '-');

                            // Update data kuliah (loop untuk banyak data kuliah)
                            let kuliahHTML = '';
                            if (response.kuliah.length > 0) {
                                response.kuliah.forEach(function(kuliah) {
                                    kuliahHTML += `
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Nama Universitas</span>
                                <span class="fw-bold">${kuliah.nama_universitas || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Fakultas</span>
                                <span class="fw-bold">${kuliah.fakultas || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Program Studi</span>
                                <span class="fw-bold">${kuliah.program_studi || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Jenjang</span>
                                <span class="fw-bold">${kuliah.jenjang || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Status Kuliah</span>
                                <span class="fw-bold">${kuliah.status_kuliah || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Jalur Masuk</span>
                                <span class="fw-bold">${kuliah.jalur_masuk || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Tahun Masuk</span>
                                <span class="fw-bold">${kuliah.tahun_masuk || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Tahun Lulus</span>
                                <span class="fw-bold">${kuliah.tahun_lulus || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary me-2 mdi mdi-pencil edit-button-kuliah fw-bold" data-id="${kuliah.id}" data-alumni-id="${kuliah.alumni_id}" data-bs-toggle="modal"
                                    data-bs-target="#modal_edit_kuliah"> Edit</button>
                                <button type="button" class="btn btn-danger mdi mdi-delete delete-button-kuliah fw-bold" data-id="${kuliah.id}" data-alumni-id="${kuliah.alumni_id}"> Hapus</button>
                            </div>
                            <br />
                        `;
                                });
                            } else {
                                kuliahHTML +=
                                    `<p class="text-muted">Data kuliah tidak ditemukan.</p>`;
                            }
                            $('#kuliah-list').html(kuliahHTML);

                            // Update data kerja (loop untuk banyak data kerja)
                            let kerjaHTML = '';
                            if (response.kerja.length > 0) {
                                response.kerja.forEach(function(kerja) {
                                    kerjaHTML += `
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Tempat Kerja</span>
                                <span class="fw-bold">${kerja.tempat_kerja || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Posisi Kerja</span>
                                <span class="fw-bold">${kerja.posisi_kerja || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Alamat Kerja</span>
                                <span class="fw-bold">${kerja.alamat_kerja || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="me-2 text-muted">Tahun Masuk</span>
                                <span class="fw-bold">${kerja.tahun_masuk || '-'}</span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary me-2 mdi mdi-pencil edit-button-kerja fw-bold" data-id="${kerja.id}" data-alumni-id="${kerja.alumni_id}" data-bs-toggle="modal"
                                    data-bs-target="#modal_edit_kerja"> Edit</button>
                                <button type="button" class="btn btn-danger mdi mdi-delete delete-button-kerja fw-bold" data-id="${kerja.id}" data-alumni-id="${kerja.alumni_id}"> Hapus</button>
                            </div>
                            <br />
                        `;
                                });
                            } else {
                                kerjaHTML +=
                                    `<p class="text-muted">Data kerja tidak ditemukan.</p>`;
                            }
                            $('#kerja-list').html(kerjaHTML);
                        } else {
                            alert('Data alumni tidak ditemukan.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            }
            // ============================ End Get Data Alumni ==============================

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
                        $('#modal_add_kuliah').modal('hide');
                        resetFormKuliah('#modal_add_kuliah_form');
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================

            // ============================ Start Create Kuliah ==============================
            $('#modal_add_kuliah_form').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit langsung

                // Bersihkan error sebelumnya
                clearErrorFeedback();

                // Tampilkan konfirmasi
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Anda yakin ingin membuat data kuliah ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Buat!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan AJAX POST
                        $.ajax({
                            url: `{{ route('landing.storeKuliah') }}`,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: `{{ csrf_token() }}`,
                                nama_universitas: $('#nama_universitas').val(),
                                fakultas: $('#fakultas').val(),
                                program_studi: $('#program_studi').val(),
                                jenjang: $('#jenjang').val(),
                                status_kuliah: $('#status_kuliah').val(),
                                jalur_masuk: $('#jalur_masuk').val(),
                                tahun_masuk: $('#tahun_masuk_kuliah').val(),
                                tahun_lulus: $('#tahun_lulus_kuliah').val()
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message
                                    });
                                    getData();
                                    $('#modal_add_kuliah').modal('hide');
                                    resetFormKuliah('#modal_add_kuliah_form');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message
                                    });
                                }
                            },
                            error: function(xhr) {
                                // Jika validasi gagal (Laravel -> status 422)
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    showValidationErrors(errors);
                                } else {
                                    // Error lain (misal 500)
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: 'Silakan coba lagi'
                                    });
                                }
                            }
                        });
                    }
                });
            });
            // ============================ End Create Kuliah ==============================

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
                        $('#modal_edit_kuliah').modal('hide');
                        resetFormKuliah('#modal_edit_kuliah_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Show Modal Edit Kuliah ==============================
            $(document).on('click', '.edit-button-kuliah', function() {
                var id = $(this).data('id');
                var alumniId = $(this).data('alumni-id');
                var editUrl = '{{ route('landing.editKuliah', [':alumni_id', ':id']) }}'
                    .replace(':alumni_id', alumniId)
                    .replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    success: function(response) {

                        $('#edit_id_kuliah').val(response.kuliah.id);
                        $('#edit_alumni_id').val(alumniId);
                        $('#edit_nama_universitas').val(response.kuliah.nama_universitas);
                        $('#edit_fakultas').val(response.kuliah.fakultas);
                        $('#edit_program_studi').val(response.kuliah.program_studi);
                        $('#edit_jenjang').val(response.kuliah.jenjang);
                        $('#edit_jalur_masuk').val(response.kuliah.jalur_masuk);
                        $('#edit_status_kuliah').trigger('change').val(response.kuliah
                                .status_kuliah)
                            .trigger('change');
                        $('#edit_tahun_masuk_kuliah').val(response.kuliah.tahun_masuk);
                        $('#edit_tahun_lulus_kuliah').val(response.kuliah.tahun_lulus);
                        $('#modal_edit_kuliah_form').attr('action',
                            '{{ route('landing.updateKuliah', [':alumni_id', ':id']) }}'
                            .replace(':alumni_id', alumniId)
                            .replace(':id', response.kuliah.id));
                        $('#modal_edit_kuliah').modal('show');
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
            // ============================ End Show Modal Edit Kuliah ==============================

            // ============================ Start Edit Kuliah ==============================
            $('#modal_edit_kuliah_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = $(this).data('alumni-id');
                var id = $('#edit_id_kuliah').val();
                var url = '{{ route('landing.updateKuliah', [':alumni_id', ':id']) }}'
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
                                getData();
                                $('#modal_edit_kuliah').modal('hide');
                                resetFormKuliah('#modal_edit_kuliah_form');
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
                var alumniId = $(this).data('alumni-id');
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Anda yakin ingin menghapus data kuliah ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ route('landing.deleteKuliah', [':alumni_id', ':id']) }}'
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
                                getData();
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
                        $('#modal_add_kerja').modal('hide');
                        resetFormKerja('#modal_add_kerja_form');
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================

            // ============================ Start Create Kerja ==============================
            $('#modal_add_kerja_form').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit langsung

                // Bersihkan error sebelumnya
                clearErrorFeedback();

                // Tampilkan konfirmasi
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Anda yakin ingin membuat data kerja ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Buat!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan AJAX POST
                        $.ajax({
                            url: `{{ route('landing.storeKerja') }}`,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: `{{ csrf_token() }}`,
                                posisi_kerja: $('#posisi_kerja').val(),
                                tempat_kerja: $('#tempat_kerja').val(),
                                alamat_kerja: $('#alamat_kerja').val(),
                                tahun_masuk: $('#tahun_masuk_kerja').val(),
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message
                                    });
                                    getData();
                                    $('#modal_add_kerja').modal('hide');
                                    resetFormKerja('#modal_add_kerja_form');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message
                                    });
                                }
                            },
                            error: function(xhr) {
                                // Jika validasi gagal (Laravel -> status 422)
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    showValidationErrors(errors);
                                } else {
                                    // Error lain (misal 500)
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: 'Silakan coba lagi'
                                    });
                                }
                            }
                        });
                    }
                });
            });
            // ============================ End Create Kerja ==============================

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
                        $('#modal_edit_kerja').modal('hide');
                        resetFormKerja('#modal_edit_kerja_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Show Modal Edit Kerja ==============================
            $(document).on('click', '.edit-button-kerja', function() {
                var id = $(this).data('id');
                var alumniId = $(this).data('alumni-id');
                var editUrl = '{{ route('landing.editKerja', [':alumni_id', ':id']) }}'
                    .replace(':alumni_id', alumniId)
                    .replace(':id', id);

                console.log(editUrl);

                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    success: function(response) {

                        $('#edit_id_kerja').val(response.kerja.id);
                        $('#edit_alumni_id').val(alumniId);
                        $('#edit_posisi_kerja').val(response.kerja.posisi_kerja);
                        $('#edit_tempat_kerja').val(response.kerja.tempat_kerja);
                        $('#edit_alamat_kerja').val(response.kerja.alamat_kerja);
                        $('#edit_tahun_masuk_kerja').val(response.kerja.tahun_masuk);
                        $('#modal_edit_kerja_form').attr('action',
                            '{{ route('landing.updateKerja', [':alumni_id', ':id']) }}'
                            .replace(':alumni_id', alumniId)
                            .replace(':id', response.kerja.id));
                        $('#modal_edit_kerja').modal('show');
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
            // ============================ End Show Modal Edit Kerja ==============================

            // ============================ Start Edit Kerja ==============================
            $('#modal_edit_kerja_form').on('submit', function(e) {
                e.preventDefault();
                var alumniId = $(this).data('alumni-id');
                var id = $('#edit_id_kerja').val();
                var url = '{{ route('landing.updateKerja', [':alumni_id', ':id']) }}'
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
                                getData();
                                $('#modal_edit_kerja').modal('hide');
                                resetFormKerja('#modal_edit_kerja_form');
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
                var alumniId = $(this).data('alumni-id');
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Anda yakin ingin menghapus data kerja ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ route('landing.deleteKerja', [':alumni_id', ':id']) }}'
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
                                getData();
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

            // ============================ Start Cancel Edit ==============================
            $('#cancel_edit_button_sosmed, #close_modal_edit_button_sosmed').on('click', function(e) {
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
                        $('#modal_edit_sosmed').modal('hide');
                        resetFormSosmed('#modal_edit_sosmed_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Show Modal Edit Sosmed ==============================
            $(document).on('click', '.edit-button-sosmed', function() {
                var id = $(this).data('id');
                var editUrl = '{{ route('landing.editSosmed', [':id']) }}'
                    .replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    success: function(response) {

                        $('#edit_id_alumni').val(response.alumni.id);
                        $('#edit_instagram').val(response.alumni.instagram);
                        $('#edit_sosmed_lain').val(response.alumni.sosmed_lain);
                        $('#modal_edit_sosmed_form').attr('action',
                            '{{ route('landing.updateSosmed', [':alumni_id', ':id']) }}'
                            .replace(':id', response.alumni.id));
                        $('#modal_edit_sosmed').modal('show');
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
            // ============================ End Show Modal Edit Sosmed ==============================

            // ============================ Start Edit Sosmed ==============================
            $('#modal_edit_sosmed_form').on('submit', function(e) {
                e.preventDefault();
                var id = $('#edit_id_alumni').val();
                var url = '{{ route('landing.updateSosmed', [':id']) }}'
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
                                getData();
                                $('#modal_edit_sosmed').modal('hide');
                                resetFormSosmed('#modal_edit_sosmed_form');
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
            // ============================ End Edit Sosmed ==============================

            // ============================ Start Cancel Edit ==============================
            $('#cancel_edit_button_password, #close_modal_edit_button_password').on('click', function(e) {
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
                        $('#modal_edit_password').modal('hide');
                        resetFormSosmed('#modal_edit_password_form');
                    }
                });
            });
            // ============================ End Cancel Edit ==============================

            // ============================ Start Edit Password ==============================
            $('#modal_edit_password_form').on('submit', function(e) {
                e.preventDefault();
                var id = $('#edit_id_alumni').val();
                var url = '{{ route('landing.updatePassword', [':id']) }}'
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
                                getData();
                                $('#modal_edit_password').modal('hide');
                                resetFormSosmed('#modal_edit_password_form');
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
            // ============================ End Edit Sosmed ==============================
        });
    </script>
@endpush

@push('customStyles')
    <style>
        .bg-blue {
            padding: 150px 0 80px 0;
            position: relative;
            background-color: #135fc9;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        #biodata {
            display: grid;
            grid-template-rows: auto 1fr auto;
            grid-template-columns: 100%;

            /* fallback height */
            min-height: 100vh;

            /* new small viewport height for modern browsers */
            min-height: 100svh;
        }

        #biodata-content {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #data_pribadi .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 180px;
            height: 30px;
            padding: 0;
        }

        #kuliah .btn,
        #kerja .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 30px;
        }

        .modal-body {
            padding: 15px 30px;
        }

        .form-select,
        .form-control {
            padding: 7px 12px;
            border-color: rgba(37, 39, 43, 0.2);
            box-shadow: rgba(149, 157, 165, 0.08) 0px 8px 24px;
            font-size: 14px;
        }

        .form-select:focus {
            box-shadow: rgba(149, 157, 165, 0.08) 0px 8px 24px;
            border-color: #3f8efc;
        }

        .form-select::-moz-placeholder {
            color: #ced4da;
        }

        .form-select::placeholder {
            color: #ced4da;
        }

        .form-select option {
            padding: 10px;
        }
    </style>
@endpush
