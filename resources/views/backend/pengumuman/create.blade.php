<div class="modal fade" id="kt_modal_add_pengumuman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengumuman</h5>
                <button type="button" class="btn-close" id="close_modal_button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kt_modal_add_pengumuman_form" method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="foto" class="form-label required">Foto</label>
                                <div class="fv-row">
                                    <div class="dropzone" id="foto">
                                        <div class="dz-message needsclick">
                                            <i class="ki-duotone ki-file-up fs-3x text-primary">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Geser file foto atau klik
                                                    disini untuk upload foto.</h3>
                                                <span class="fs-7 fw-semibold text-gray-500">Upload satu file
                                                    foto</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="judul" class="form-label required">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Masukkan Judul">
                                @error('judul')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="isi" class="form-label required">Isi</label>
                                <textarea type="text" class="form-control ckeditor" id="isi" name="isi" rows="10"
                                    placeholder="Masukkan Isi"></textarea>
                                @error('isi')
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
