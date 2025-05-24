<div class="modal fade" id="modal_edit_sosmed" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Sosmed</h6>
                <button type="button" class="btn-close" id="close_modal_edit_button_sosmed" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modal_edit_sosmed_form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_alumni" name="id_alumni">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="edit_instagram" name="instagram"
                                    placeholder="Masukkan Instagram">
                                @error('instagram')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sosmed_lain" class="form-label">Sosmed Lain</label>
                                <input type="text" class="form-control" id="edit_sosmed_lain" name="sosmed_lain"
                                    placeholder="Masukkan Sosmed yang lain">
                                @error('sosmed_lain')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-2 mt-3">Simpan</button>
                        <button type="button" class="btn btn-danger mt-3" id="cancel_edit_button_sosmed">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
