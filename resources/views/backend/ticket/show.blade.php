<div class="modal fade" id="kt_modal_show_ticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Tiket</h5>
                <button type="button" class="btn-close" id="close_modal_show_button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <table class="table table-bordered">
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
                            </div>
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 id="show_judul"></h2>
                                        <div class="card-text" id="show_deskripsi"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h3>Balasan Tiket</h3>
                                <div class="card">
                                    <div class="card-body">
                                        <div id="replies">
                                        </div>
                                        <div class="mb-3">
                                            <h5>Balas Tiket</h5>
                                            <form id="kt_modal_add_ticket_reply_form" action="" method="POST">
                                                @csrf
                                                <textarea class="form-control mb-3 ckeditor" id="reply_text" name="reply_text" rows="4"
                                                    placeholder="Masukkan teks balasan"></textarea>
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
            </div>
        </div>
    </div>
</div>
