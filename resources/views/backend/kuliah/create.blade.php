<div class="modal fade" id="kt_modal_add_kuliah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kuliah</h5>
                <button type="button" class="btn-close" id="close_modal_button_kuliah" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kt_modal_add_kuliah_form" method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_universitas" class="form-label required">Nama Universitas</label>
                                <input type="text" class="form-control" id="nama_universitas" name="nama_universitas"
                                    placeholder="Masukkan nama universitas">
                                @error('nama_universitas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fakultas" class="form-label required">Fakultas</label>
                                <input type="text" class="form-control" id="fakultas" name="fakultas"
                                    placeholder="Masukkan fakultas">
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
                                <input type="text" class="form-control" id="program_studi" name="program_studi"
                                    placeholder="Masukkan program studi">
                                @error('program_studi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenjang" class="form-label required">Jenjang</label>
                                <input type="text" class="form-control" id="jenjang" name="jenjang"
                                    placeholder="Masukkan jenjang">
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
                                <input type="text" class="form-control" id="jalur_masuk" name="jalur_masuk"
                                    placeholder="Masukkan jalur masuk">
                                @error('jalur_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_kuliah" class="form-label required">Status Kuliah</label>
                                <select class="form-select" data-control="select2"
                                    data-placeholder="Pilih Status Kuliah" data-hide-search="true" id="status_kuliah"
                                    name="status_kuliah">
                                    <option value="" disabled selected>Pilih Status Kuliah</option>
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
                                <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk"
                                    placeholder="Masukkan tahun masuk">
                                @error('tahun_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus"
                                    placeholder="Wajib diisi jika status kuliah adalah Lulus">
                                @error('tahun_lulus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-danger mt-3" id="cancel_button_kuliah">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
