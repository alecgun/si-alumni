<div class="modal fade" id="modal_edit_password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah User</h5>
                <button type="button" class="btn-close" id="close_modal_edit_button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modal_edit_password_form" method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan Password Baru">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Masukkan Konfirmasi Password">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3 me-2">Simpan</button>
                        <button type="button" class="btn btn-danger mt-3" id="cancel_edit_button">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
