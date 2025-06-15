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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Support Ticket
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
                        <li class="breadcrumb-item text-muted">Support Ticket</li>
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
                                <input type="text" id="ticket_search" data-kt-ticket-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Cari ticket" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div id="ticket_table">
                            @include('backend.ticket.table')
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
    @can('ticket.create')
        @include('backend.ticket.create')
    @endcan
    @can('ticket.show')
        @include('backend.ticket.show')
    @endcan
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
            // ============================ Start DataTable ==============================
            var table = $('#kt_table_tickets').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [4, 'desc']
                ],
                ajax: '{{ route('ticket') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'status_ticket',
                        name: 'status_ticket'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'nama_alumni',
                        name: 'nama_alumni'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#ticket_search').on('keyup', function() {
                table.search(this.value).draw();
            });
            // ============================ End DataTable ==============================

            // ============================ Start Reset Form ==============================
            function resetForm(form) {
                $(form)[0].reset();
                $(form).find('input[name="id_ticket"], input[name="id_ticket_reply"]').val('');
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
                        $('#kt_modal_add_ticket').modal('hide');
                        resetForm('#kt_modal_add_ticket_form');
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================

            // ============================ Start Tambah Ticket ==============================
            $('#kt_modal_add_ticket_form').on('submit', function(e) {
                e.preventDefault();
                var url = '{{ route('ticket.store') }}';
                let form = $(this);
                var formData = new FormData(this);

                formData.append('status_ticket', 'Open');

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
                                $('#kt_modal_add_ticket').modal('hide');
                                table.ajax.reload();
                                resetForm('#kt_modal_add_ticket_form');
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
            // ============================ End Tambah Ticket ==============================

            // ============================ Start Show Modal Show ==============================
            $(document).on('click', '.show-button', function() {
                var id = $(this).data('id');
                var showUrl = '{{ route('ticket.show', ':id') }}'.replace(':id', id);
                loadTicketReplies(id);

                $.ajax({
                    type: 'GET',
                    url: showUrl,
                    success: function(response) {
                        $('#show_id_ticket').html(response.id);
                        $('#show_kategori').html(response.kategori);
                        $('#show_status_ticket').html(response.status_ticket);
                        $('#show_judul').html(response.judul);
                        $('#show_deskripsi').html(response.deskripsi);
                        $('#show_email').html(response.email);
                        $('#show_alumni_id').html(response.nama_alumni);
                        $('#show_created_at').html(moment(response.created_at).locale('id')
                            .format(
                                'D MMMM YYYY, HH:mm'));
                        $('#kt_modal_show_ticket').modal('show');
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
            // ============================ End Show Modal Show ==============================

            // ============================ Start Show Replies on Modal Show Ticket ==============================
            function loadTicketReplies(ticketId) {
                $.ajax({
                    url: '{{ route('ticket-reply.replies', ':id') }}'.replace(':id', ticketId),
                    method: 'GET',
                    success: function(data) {
                        let repliesContainer = $('#replies');
                        repliesContainer.empty(); // Kosongkan kontainer sebelum menambahkan

                        if (data.length === 0) {
                            repliesContainer.append('<p>Belum ada balasan.</p>');
                        } else {
                            data.forEach(function(reply) {
                                const date = new Date(reply.created_at);
                                const tanggal = date.toLocaleDateString('id-ID', {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                });

                                const jam = date.getHours().toString().padStart(2, '0');
                                const menit = date.getMinutes().toString().padStart(2, '0');

                                const formattedDate = `${tanggal}, ${jam}:${menit}`;

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

            // ============================ End Show Replies on Modal Show Ticket ==============================

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
                                'responsive'
                            ],
                            upload: {
                                types: ['jpeg', 'jpg', 'png', 'gif']
                            },
                        },
                        simpleUpload: {
                            uploadUrl: `{{ route('ticket-reply.store-image') }}`,
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

            // ============================ Start Tambah Reply Ticket ==============================
            $('#kt_modal_add_ticket_reply_form').on('submit', function(e) {
                e.preventDefault();
                var url = '{{ route('ticket-reply.store') }}';
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
                                loadTicketReplies($('#show_id_ticket').text());
                                resetForm('#kt_modal_add_ticket_reply_form');
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
            // ============================ End Tambah Ticket ==============================

            // ============================ Start Cancel Show ==============================
            $('#cancel_show_button, #close_modal_show_button').on('click', function(e) {
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
                        $('#kt_modal_show_ticket').modal('hide');
                        resetForm('#kt_modal_add_ticket_reply_form');
                    }
                });
            });
            // ============================ End Cancel Show ==============================

            // ============================ Start Delete Ticket ==============================
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
                            url: '{{ route('ticket.destroy', ':id') }}'.replace(':id', id),
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
            // ============================ End Delete Ticket ==============================
        });
    </script>
@endpush

@push('customStyles')
    <style>
        #show_deskripsi img,
        #show_reply_text img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endpush
