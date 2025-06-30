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
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            {{-- @if ($user->img_user)
                            <div class="me-3">
                                <img src="{{ Storage::url(Auth::user()->img_user) }}" alt="Foto Profil"
                                    class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                        @else
                            <div class="me-3">
                                <img src="{{ asset('backend-assets/media/logos/null-data.png') }}" alt="Foto Profil"
                                    class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                        @endif --}}
                            <div class="me-4">
                                <img src="{{ $alumni->img_user ? url('storage/' . $alumni->img_user) : asset('frontend-assets/images/users/placeholder.png') }}"
                                    alt="Alumni Photo" class="img-fluid rounded object-fit-cover"
                                    style="height: 100px;">
                            </div>
                            <input type="file" name="img_user" accept="image/*"
                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
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
