@extends('frontend.page.parts.master')
@section('content')
    <!-- START HERO -->
    <section class="bg-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white">
                        <h2 class="text-white fw-bold">Detail Tiket</h2>
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
                <div class="col-lg-12 shadow-sm p-4" id="ticket">
                    <table class="table mb-3">
                        <tr>
                            <th class="fw-bold" width="15%">ID Tiket</th>
                            <td id="show_id_ticket"></td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Kategori</th>
                            <td id="show_kategori"></td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Status Tiket</th>
                            <td id="show_status_ticket"></td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Dibuat Pada</th>
                            <td id="show_created_at"></td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Nama</th>
                            <td id="show_id_user"></td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Email</th>
                            <td id="show_email"></td>
                        </tr>
                    </table>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 id="show_judul"></h3>
                                <div id="show_deskripsi"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h5>Balasan Tiket</h5>
                        <div class="card">
                            <div class="card-body">
                                <div id="replies">
                                </div>
                                <div class="mb-3">
                                    <h5>Balas Tiket</h5>
                                    <form id="add_ticket_reply_form" action="" method="POST">
                                        @csrf
                                        <textarea class="form-control ckeditor" id="reply_text" name="reply_text" rows="4"
                                            placeholder="Buat teks balasan"></textarea>
                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-primary">Kirim
                                                Balasan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                $(form).find('input[name="id_ticket_reply"]').val('');
                $(form).find('select').val('').trigger('change');
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();
            }

            function clearValidationErrors(form) {
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.text-danger').remove();
            }
            // ============================ End Reset Form ==============================

            // ============================ Start Show Ticket ==============================
            var ticketId = '{{ $ticket->id }}';
            var dataUrl = '{{ route('landing.ticket.data', ':id') }}'.replace(':id', ticketId);
            loadTicketReplies(ticketId);

            $.ajax({
                url: dataUrl,
                type: 'GET',
                success: function(response) {
                    $('#show_id_ticket').html(response.ticket.id);
                    $('#show_kategori').html(response.ticket.kategori);
                    $('#show_status_ticket').html(response.ticket.status_ticket);
                    $('#show_created_at').html(response.ticket.formatted_date);
                    $('#show_id_user').html(response.ticket.nama_user);
                    $('#show_email').html(response.ticket.email);
                    $('#show_judul').html(response.ticket.judul);
                    $('#show_deskripsi').html(response.ticket.deskripsi);
                },
                error: function(xhr) {
                    alert('Gagal mengambil data tiket');
                }
            });
            // ============================ End Show Ticket ==============================

            // ============================ Start Show Replies ==============================
            function loadTicketReplies(ticketId) {
                var showUrl = '{{ route('landing.ticket-reply.show', ':id') }}'.replace(':id', ticketId);

                $.ajax({
                    url: showUrl,
                    method: 'GET',
                    success: function(data) {
                        let repliesContainer = $('#replies');
                        repliesContainer.empty(); // Kosongkan kontainer sebelum menambahkan

                        if (data.ticket_reply.length === 0) {
                            repliesContainer.append('<p class="text-muted">Belum ada balasan.</p>');
                        } else {
                            data.ticket_reply.forEach(function(reply) {
                                const date = new Date(reply.created_at);
                                const tanggal = date.getDate().toString().padStart(2, '0');
                                const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei',
                                    'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                    'November', 'Desember'
                                ][date.getMonth()];
                                const tahun = date.getFullYear();

                                const formattedDate =
                                    `${tanggal} ${bulan} ${tahun} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;

                                let replyHtml = `
                        <div class="mb-3 border-bottom pb-2">
                            <div class="d-flex justify-content-between">
                                <strong>${reply.nama_user}</strong>
                                <small class="text-muted">${formattedDate}</small>
                            </div>
                            <div id="show_reply_text" class="mb-0">${reply.reply_text}</div>
                        </div>
                    `;
                                repliesContainer.append(replyHtml);
                            });
                        }
                    },
                    error: function(xhr) {
                        $('#replies').html('<p class="text-danger">Gagal memuat balasan tiket.</p>');
                    }
                });
            }
            // ============================ End Show Replies ==============================

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
                                'resizeImage'
                            ],
                            styles: [
                                'full',
                                'side',
                                'responsive' // Add responsive style option
                            ],
                            upload: {
                                types: ['jpeg', 'jpg', 'png', 'gif']
                            },
                        },
                        simpleUpload: {
                            uploadUrl: `{{ route('landing.ticket-reply.store-img') }}`,
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
                        placeholder: 'Buat teks balasan',
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

            // ============================ Start Tambah Ticket Reply ==============================
            $('#add_ticket_reply_form').on('submit', function(e) {
                e.preventDefault();
                var url = '{{ route('landing.ticket-reply.store') }}';
                let form = $(this);
                var formData = new FormData(this);

                formData.append('id_user', '{{ auth()->user()->id }}');
                formData.append('id_ticket', $('#show_id_ticket').text());

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
                                editors['reply_text'].setData('');
                                loadTicketReplies(ticketId);
                                resetForm('#add_ticket_reply_form');
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
            // ============================ End Tambah Ticket Reply ==============================
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

        #show_deskripsi img,
        #show_reply_text img {
            max-width: 100%;
            height: auto;
        }

        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endpush
