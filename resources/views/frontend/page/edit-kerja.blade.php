<div class="modal fade" id="modal_edit_kerja" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Kerja</h5>
                <button type="button" class="btn-close" id="close_modal_edit_button_kerja" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modal_edit_kerja_form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_kerja" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="posisi_kerja" class="form-label">Posisi Kerja</label>
                                <input type="text" class="form-control" id="edit_posisi_kerja" name="posisi_kerja"
                                    placeholder="Masukkan Posisi Kerja">
                                @error('posisi_kerja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempat_kerja" class="form-label">Tempat Kerja</label>
                                <input type="text" class="form-control" id="edit_tempat_kerja" name="tempat_kerja"
                                    placeholder="Masukkan Tempat Kerja">
                                @error('tempat_kerja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="alamat_kerja" class="form-label">Alamat Tempat Kerja</label>
                                <input type="text" class="form-control" id="edit_alamat_kerja" name="alamat_kerja"
                                    placeholder="Masukkan Alamat Tempat Kerja">
                                @error('alamat_kerja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="text" class="form-control" id="edit_tahun_masuk_kerja"
                                    name="tahun_masuk" placeholder="Masukkan Tahun Masuk">
                                @error('tahun_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        <button type="button" class="btn btn-secondary mt-3" id="cancel_edit_button_kerja">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
