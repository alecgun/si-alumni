<div class="modal fade" id="modal_edit_kuliah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Data Kuliah</h6>
                <button type="button" class="btn-close" id="close_modal_edit_button_kuliah" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modal_edit_kuliah_form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_kuliah" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_universitas" class="form-label required">Nama Universitas</label>
                                <input type="text" class="form-control" id="edit_nama_universitas"
                                    name="nama_universitas" placeholder="Masukkan Nama Universitas">
                                @error('nama_universitas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fakultas" class="form-label required">Fakultas</label>
                                <input type="text" class="form-control" id="edit_fakultas" name="fakultas"
                                    placeholder="Masukkan Fakultas">
                                @error('fakultas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="program_studi" class="form-label required">Program Studi</label>
                                <input type="text" class="form-control" id="edit_program_studi" name="program_studi"
                                    placeholder="Masukkan Program Studi">
                                @error('program_studi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenjang" class="form-label required">Jenjang</label>
                                <input type="text" class="form-control" id="edit_jenjang" name="jenjang"
                                    placeholder="Masukkan Jenjang">
                                @error('jenjang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jalur_masuk" class="form-label required">Jalur Masuk</label>
                                <input type="text" class="form-control" id="edit_jalur_masuk" name="jalur_masuk"
                                    placeholder="Masukkan Jalur Masuk">
                                @error('jalur_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_kuliah" class="form-label required">Status Kuliah</label>
                                <select class="form-select" id="edit_status_kuliah" name="status_kuliah"
                                    data-control="select2" data-placeholder="Pilih Status Kuliah"
                                    data-hide-search="true">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Lulus">Lulus</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                    <option value="Drop Out">Drop Out</option>
                                </select>
                                @error('status_kuliah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_masuk" class="form-label required">Tahun Masuk</label>
                                <input type="text" class="form-control" id="edit_tahun_masuk_kuliah"
                                    name="tahun_masuk" placeholder="Masukkan Tahun Masuk">
                                @error('tahun_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control" id="edit_tahun_lulus_kuliah"
                                    name="tahun_lulus" placeholder="Masukkan Tahun Lulus">
                                @error('tahun_lulus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3 me-2">Simpan</button>
                        <button type="button" class="btn btn-danger mt-3"
                            id="cancel_edit_button_kuliah">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
