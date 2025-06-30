<div class="modal fade" id="kt_modal_edit_profile_photo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Foto Profil</h5>
                <button type="button" class="btn-close" id="close_modal_edit_button_photo" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kt_modal_edit_profile_photo_form" method="POST" action="">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-md-2 justify-content-end d-flex">
                            <div class="me-4">
                                <img src="{{ $alumni->img_user ? url('storage/' . $alumni->img_user) : asset('frontend-assets/images/users/placeholder.png') }}"
                                    alt="Alumni Photo" class="rounded object-fit-cover ratio-4x6"
                                    style="height: 150px;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <input type="file" name="img_user" accept="image/*"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                            <div class="row">
                                <p class="text-muted mt-2">Format: jpg, png, jpeg. Aspect ratio yang
                                    direkomendasikan:
                                    4x6</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3 me-3">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-secondary mt-3" id="cancel_button_photo">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
