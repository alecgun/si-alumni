<div class="modal fade" id="modal_add_kerja" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Kerja</h6>
                <button type="button" class="btn-close" id="close_modal_button_kerja" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modal_add_kerja_form" method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="posisi_kerja" class="form-label">Posisi Kerja</label>
                                <input type="text" class="form-control" id="posisi_kerja" name="posisi_kerja"
                                    placeholder="Masukkan posisi kerja">
                                @error('posisi_kerja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempat_kerja" class="form-label">Tempat Kerja</label>
                                <input type="text" class="form-control" id="tempat_kerja" name="tempat_kerja"
                                    placeholder="Masukkan tempat kerja">
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
                                <input type="text" class="form-control" id="alamat_kerja" name="alamat_kerja"
                                    placeholder="Masukkan alamat tempat kerja">
                                @error('alamat_kerja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="text" class="form-control" id="tahun_masuk_kerja" name="tahun_masuk"
                                    placeholder="Masukkan tahun masuk">
                                @error('tahun_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3 me-2">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-danger mt-3" id="cancel_button_kerja">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
