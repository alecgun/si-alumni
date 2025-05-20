<div class="modal fade" id="kt_modal_add_alumni" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Alumni</h5>
                <button type="button" class="btn-close" id="close_modal_button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kt_modal_add_alumni_form" method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nis" class="form-label required">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis"
                                    placeholder="Masukkan NIS">
                                @error('nis')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label required">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
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
                                <label for="kelas" class="form-label required">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    placeholder="Masukkan Kelas">
                                @error('kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    placeholder="Pilih Tanggal Lahir">
                                @error('tanggal_lahir')
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
                                    placeholder="Masukkan Tahun Masuk">
                                @error('tahun_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_lulus" class="form-label required">Tahun Lulus</label>
                                <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus"
                                    placeholder="Masukkan Tahun Lulus">
                                @error('tahun_lulus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram"
                                    placeholder="Masukkan Instagram">
                                @error('instagram')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sosmed_lain" class="form-label">Sosmed Lain</label>
                                <input type="text" class="form-control" id="sosmed_lain" name="sosmed_lain"
                                    placeholder="Masukkan Sosmed yang lain">
                                @error('sosmed_lain')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_user" class="form-label">User</label>
                                <select class="form-select" data-control="select2" data-placeholder="Pilih User"
                                    data-hide-search="true" id="id_user" name="id_user">
                                </select>
                                @error('id_user')
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
