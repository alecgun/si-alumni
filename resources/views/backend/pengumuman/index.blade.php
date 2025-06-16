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
                        Pengumuman
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
                        <li class="breadcrumb-item text-muted">Pengumuman</li>
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
                                <input type="text" id="pengumuman_search" data-kt-pengumuman-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Cari pengumuman" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-pengumuman-table-toolbar="base">
                                <!--begin::Add pengumuman-->
                                @can('pengumuman.create')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_pengumuman">
                                        <i class="ki-duotone ki-plus fs-2"></i> Tambah Pengumuman
                                    </button>
                                @endcan
                                <!--end::Add pengumuman-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div id="pengumuman_table">
                            @include('backend.pengumuman.table')
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
    @can('pengumuman.create')
        @include('backend.pengumuman.create')
    @endcan
    @can('pengumuman.edit')
        @include('backend.pengumuman.edit')
    @endcan
    @can('pengumuman.show')
        @include('backend.pengumuman.show')
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // ============================ Start DataTable ==============================
            var table = $('#kt_table_pengumumans').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [4, 'desc']
                ],
                ajax: '{{ route('pengumuman') }}',
                columns: [{
                        data: 'iteration',
                        name: 'iteration',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'judul',
                        name: 'judul'
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

            $('#pengumuman_search').on('keyup', function() {
                table.search(this.value).draw();
            });
            // ============================ End DataTable ==============================

            // ============================ Start Reset Form ==============================
            function resetForm(form) {
                $(form)[0].reset();
                $(form).find('input[name="id_pengumuman"]').val('');
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
                        $('#kt_modal_add_pengumuman').modal('hide');
                        resetForm('#kt_modal_add_pengumuman_form');
                        myDropzone.removeAllFiles(true);
                        myDropzone.destroy();
                    }
                });
            });
            // ============================ End Action Cancel Add ==============================

            // ============================ Start Dropzone Create ==============================
            var myDropzone = new Dropzone("#foto", {
                url: "{{ route('pengumuman.store') }}",
                paramName: "foto",
                maxFiles: 1,
                maxFilesize: 10,
                acceptedFiles: ".png,.jpg,.jpeg",
                addRemoveLinks: true,
                dictDefaultMessage: "Geser file foto atau klik disini untuk upload foto.",
                init: function() {
                    var dropzoneInstance = this;

                    $('#kt_modal_add_pengumuman_form').on('reset', function() {
                        dropzoneInstance.removeAllFiles(true);
                    });

                    this.on("addedfile", function(file) {
                        if (this.files[1] != null) {
                            this.removeFile(this.files[0]);
                        }
                    });
                },
            });

            $('#kt_modal_add_pengumuman').on('show.bs.modal', function() {
                Dropzone.autoDiscover = false;
            });
            // ============================ End Dropzone Create ==============================

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
                            uploadUrl: `{{ route('pengumuman.store-image') }}`,
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
                        placeholder: 'Buat isi pengumuman',
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

            // ============================ Start Tambah Pengumuman ==============================
            $('#kt_modal_add_pengumuman_form').on('submit', function(e) {
                e.preventDefault();
                var url = '{{ route('pengumuman.store') }}';
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
                        if (myDropzone.getAcceptedFiles().length > 0) {
                            var file = myDropzone.getAcceptedFiles()[0];
                            formData.append('foto', file, file.name);
                        }

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
                                $('#kt_modal_add_pengumuman').modal('hide');
                                table.ajax.reload();
                                myDropzone.removeAllFiles(true);
                                resetForm('#kt_modal_add_pengumuman_form');
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
            // ============================ End Tambah Pengumuman ==============================

            // ============================ Start Show Modal Show ==============================
            $(document).on('click', '.show-button', function() {
                var id = $(this).data('id');
                var showUrl = '{{ route('pengumuman.show', ':id') }}'.replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: showUrl,
                    success: function(response) {
                        $('#show_judul').html(response.judul);
                        $('#show_isi').html(response.isi);
                        // Set the creation date
                        $('#show_created_at').text('Diposting pada: ' + moment(response
                            .created_at).locale('id').format('D MMMM YYYY, HH:mm'));

                        // Handle the photo
                        if (response.foto) {
                            // Assuming foto contains the image path
                            $('#show_foto').attr('src', '{{ asset('storage') }}/' +
                                response.foto);
                            $('#show_foto_container').show();
                        } else {
                            $('#show_foto_container').hide();
                        }
                        $('#kt_modal_show_pengumuman').modal('show');
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

            // ============================ Start Cancel Show ==============================
            $('#cancel_show_button, #close_modal_show_button').on('click', function(e) {
                e.preventDefault();
                $('#kt_modal_show_pengumuman').modal('hide');
            });
            // ============================ End Cancel Show ==============================

            // ============================ Start Delete Pengumuman ==============================
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
                            url: '{{ route('pengumuman.destroy', ':id') }}'.replace(':id',
                                id),
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
            // ============================ End Delete Pengumuman ==============================
        });
    </script>
@endpush

@push('customStyles')
    <style>
        #show_isi img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endpush
