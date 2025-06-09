<div class="modal fade" id="kt_modal_edit_ticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Ticket</h5>
                <button type="button" class="btn-close" id="close_modal_edit_button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kt_modal_edit_ticket_form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_ticket" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="judul" class="form-label required">Judul</label>
                                <input type="text" class="form-control" id="edit_judul" name="judul"
                                    placeholder="Masukkan Judul">
                                @error('judul')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori" class="form-label required">Kategori</label>
                                <select class="form-select" data-control="select2" data-placeholder="Pilih Kategori"
                                    data-hide-search="true" id="edit_kategori" name="kategori">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Ora Umum">Ora Umum</option>
                                </select>
                                @error('kategori')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label required">Deskripsi</label>
                                <textarea type="text" class="form-control" id="edit_deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi"></textarea>
                                @error('deskripsi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email"
                                    placeholder="Masukkan Email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="alumni_id" class="form-label">Alumni</label>
                                <select class="form-select" data-control="select2" data-placeholder="Pilih Alumni"
                                    data-hide-search="true" id="edit_alumni_id" name="alumni_id">
                                </select>
                                @error('alumni_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3 me-3">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-secondary mt-3" id="cancel_button">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
