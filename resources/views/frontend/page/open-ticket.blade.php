@extends('frontend.page.parts.master')
@section('content')
    <!-- START HERO -->
    <section class="bg-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white">
                        <h2 class="text-white fw-bold">Buka Tiket Bantuan</h2>
                        {{-- <nav aria-label="breadcrumb" class="mt-3">
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                                <li class="breadcrumb-item active text-white-50" aria-current="page">Biodata Alumni</li>
                            </ul>
                        </nav> --}}
                        <p class="text-white-50">Silakan isi formulir di bawah ini untuk membuka tiket bantuan baru.</p>
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
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 shadow-sm p-4" id="ticket">
                    <form id="add_ticket_form" method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label><span class="text-danger">
                                *</span>
                            <p class="card-text text-muted">Harap menggunakan alamat email yang valid untuk mendapatkan
                                respon jawaban dari tiket yang diajukan</p>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-bold">Kategori</label><span class="text-danger">
                                *</span>
                            <select class="form-select" data-control="select2" data-placeholder="Pilih Kategori"
                                data-hide-search="true" id="kategori" name="kategori">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Pengumuman">Pengumuman</option>
                                <option value="Tambah Data User/Alumni">Tambah Data User/Alumni</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                            @error('kategori')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-bold">Judul Tiket</label><span class="text-danger">
                                *</span>
                            <input type="text" class="form-control" id="judul" name="judul"
                                placeholder="Masukkan judul tiket" required>
                            @error('judul')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi Tiket</label><span
                                class="text-danger">
                                *</span>
                            <textarea class="form-control ckeditor" id="deskripsi" name="deskripsi" rows="10"
                                placeholder="Masukkan deskripsi tiket"></textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Buka Tiket
                            </button>
                        </div>
                        <div class="mt-3">
                            <p class="text-muted">
                                Setelah tiket dibuka, tim kami akan segera memproses permintaan Anda.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAIN -->
@endsection

@push('customScripts')
    <script type="module">
        import {
            ClassicEditor,
            AutoImage,
            Autosave,
            BalloonToolbar,
            BlockQuote,
            Bold,
            CloudServices,
            Essentials,
            Heading,
            ImageBlock,
            ImageCaption,
            ImageEditing,
            ImageInline,
            ImageInsert,
            ImageInsertViaUrl,
            ImageResize,
            ImageStyle,
            ImageTextAlternative,
            ImageToolbar,
            ImageUpload,
            ImageUtils,
            Indent,
            IndentBlock,
            Italic,
            Link,
            LinkImage,
            List,
            ListProperties,
            Paragraph,
            SimpleUploadAdapter,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TodoList,
            Underline
        } from 'ckeditor5';

        const LICENSE_KEY = 'GPL';
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

            function resetForm(form) {
                $(form)[0].reset();
                $(form).find('input[name="id_ticket"]').val('');
                $(form).find('select').val('').trigger('change');
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();
            }

            function clearValidationErrors(form) {
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.text-danger').remove();
            }
            // ============================ End Reset Form ==============================

            // ============================ Start CKEditor ==============================
            const editors = {};

            document.querySelectorAll('.ckeditor').forEach(textarea => {
                ClassicEditor
                    .create(textarea, {
                        plugins: [
                            AutoImage,
                            Autosave,
                            BalloonToolbar,
                            BlockQuote,
                            Bold,
                            CloudServices,
                            Essentials,
                            Heading,
                            ImageBlock,
                            ImageCaption,
                            ImageEditing,
                            ImageInline,
                            ImageInsert,
                            ImageInsertViaUrl,
                            ImageResize,
                            ImageStyle,
                            ImageTextAlternative,
                            ImageToolbar,
                            ImageUpload,
                            ImageUtils,
                            Indent,
                            IndentBlock,
                            Italic,
                            Link,
                            LinkImage,
                            List,
                            ListProperties,
                            Paragraph,
                            SimpleUploadAdapter,
                            Table,
                            TableCaption,
                            TableCellProperties,
                            TableColumnResize,
                            TableProperties,
                            TableToolbar,
                            TodoList,
                            Underline
                        ],
                        toolbar: {
                            items: [
                                'undo',
                                'redo',
                                '|',
                                'heading',
                                '|',
                                'bold',
                                'italic',
                                'underline',
                                '|',
                                'link',
                                'insertImage',
                                'insertTable',
                                'blockQuote',
                                '|',
                                'bulletedList',
                                'numberedList',
                                'todoList',
                                'outdent',
                                'indent'
                            ]
                        },
                        balloonToolbar: ['bold', 'italic', '|', 'link', 'insertImage', '|',
                            'bulletedList',
                            'numberedList'
                        ],
                        heading: {
                            options: [{
                                    model: 'paragraph',
                                    title: 'Paragraph',
                                    class: 'ck-heading_paragraph'
                                },
                                {
                                    model: 'heading1',
                                    view: 'h1',
                                    title: 'Heading 1',
                                    class: 'ck-heading_heading1'
                                },
                                {
                                    model: 'heading2',
                                    view: 'h2',
                                    title: 'Heading 2',
                                    class: 'ck-heading_heading2'
                                },
                                {
                                    model: 'heading3',
                                    view: 'h3',
                                    title: 'Heading 3',
                                    class: 'ck-heading_heading3'
                                },
                                {
                                    model: 'heading4',
                                    view: 'h4',
                                    title: 'Heading 4',
                                    class: 'ck-heading_heading4'
                                },
                                {
                                    model: 'heading5',
                                    view: 'h5',
                                    title: 'Heading 5',
                                    class: 'ck-heading_heading5'
                                },
                                {
                                    model: 'heading6',
                                    view: 'h6',
                                    title: 'Heading 6',
                                    class: 'ck-heading_heading6'
                                }
                            ]
                        },
                        image: {
                            toolbar: [
                                'toggleImageCaption',
                                'imageTextAlternative',
                                '|',
                                'imageStyle:inline',
                                'imageStyle:wrapText',
                                'imageStyle:breakText',
                                '|',
                                'resizeImage',
                                '|',
                                'imageUpload'
                            ],
                            resizeUnit: '%',
                            resizeOptions: [{
                                    name: 'resizeImage:original',
                                    label: 'Original',
                                    value: null
                                },
                                {
                                    name: 'resizeImage:50',
                                    label: '50%',
                                    value: '50'
                                },
                                {
                                    name: 'resizeImage:75',
                                    label: '75%',
                                    value: '75'
                                }
                            ],
                            upload: {
                                types: ['jpeg', 'jpg', 'png', 'gif']
                            },
                        },
                        simpleUpload: {
                            uploadUrl: `{{ route('landing.ticket.store-img') }}`,
                            headers: {
                                'X-CSRF-TOKEN': `{{ csrf_token() }}`
                            },
                        },
                        link: {
                            addTargetToExternalLinks: true,
                            defaultProtocol: 'https://',
                            decorators: {
                                toggleDownloadable: {
                                    mode: 'manual',
                                    label: 'Downloadable',
                                    attributes: {
                                        download: 'file'
                                    }
                                }
                            }
                        },
                        list: {
                            properties: {
                                styles: true,
                                startIndex: true,
                                reversed: true
                            }
                        },
                        placeholder: 'Masukkan deskripsi tiket',
                        table: {
                            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells',
                                'tableProperties',
                                'tableCellProperties'
                            ]
                        },
                        htmlSupport: {
                            allow: [{
                                    name: 'div',
                                    styles: true,
                                    classes: true,
                                    attributes: true
                                },
                                {
                                    name: 'i',
                                    styles: true,
                                    classes: true,
                                    attributes: true
                                },
                                {
                                    name: 'p',
                                    styles: true,
                                    classes: true,
                                    attributes: true
                                },
                                {
                                    name: 'ul',
                                    styles: true,
                                    classes: true,
                                    attributes: true
                                },
                                {
                                    name: 'li',
                                    styles: true,
                                    classes: true,
                                    attributes: true
                                },
                                {
                                    name: 'h6',
                                    styles: true,
                                    classes: true,
                                    attributes: true
                                },
                                {
                                    name: 'img',
                                    attributes: {
                                        'src': true,
                                        'alt': true,
                                        'class': true
                                    },
                                    styles: false // Matikan semua style inline
                                }
                            ]
                        },
                        htmlEmbed: {
                            showPreviews: true
                        },
                        allowedContent: true,
                        licenseKey: LICENSE_KEY,
                    })
                    .then(editor => {
                        editors[textarea.id] = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
            // ============================ End CKEditor ==============================

            // ============================ Start Create Ticket ==============================
            $('#add_ticket_form').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit langsung

                // Bersihkan error sebelumnya
                clearErrorFeedback();

                // Tampilkan konfirmasi
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Anda yakin ingin membuka tiket?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Buat!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            html: 'Sedang membuat tiket',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                        $.ajax({
                            url: `{{ route('landing.ticket.store') }}`,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: `{{ csrf_token() }}`,
                                email: $('#email').val(),
                                kategori: $('#kategori').val(),
                                judul: $('#judul').val(),
                                deskripsi: $('#deskripsi').val(),
                                status_ticket: 'Open',
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    }).then(function() {
                                        window.location.href =
                                            `{{ route('landing.ticket.history') }}`;
                                    });
                                    resetForm('#add_ticket_form');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
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
            // ============================ End Create Ticket ==============================
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

        #ticket {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
@endpush
