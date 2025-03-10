<div class="modal fade" id="kt_modal_edit_alumni" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Alumni</h5>
                <button type="button" class="btn-close" id="close_modal_edit_button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kt_modal_edit_alumni_form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_alumni" name="id_alumni">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="edit_nis" name="nis"
                                    placeholder="Masukkan NIS" readonly>
                                @error('nis')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="edit_nama" name="nama"
                                    placeholder="Masukkan Nama">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="edit_kelas" name="kelas"
                                    placeholder="Masukkan Kelas">
                                @error('kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="text" class="form-control" id="edit_tahun_masuk" name="tahun_masuk"
                                    placeholder="Masukkan Tahun Masuk">
                                @error('tahun_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control" id="edit_tahun_lulus" name="tahun_lulus"
                                    placeholder="Masukkan Tahun Lulus">
                                @error('tahun_lulus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="edit_instagram" name="instagram"
                                    placeholder="Masukkan Instagram">
                                @error('instagram')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_sosmed_lain" class="form-label">Sosmed Lain</label>
                                <input type="text" class="form-control" id="edit_sosmed_lain" name="sosmed_lain"
                                    placeholder="Masukkan Sosmed yang lain">
                                @error('sosmed_lain')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        <button type="button" class="btn btn-secondary mt-3" id="cancel_edit_button">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
