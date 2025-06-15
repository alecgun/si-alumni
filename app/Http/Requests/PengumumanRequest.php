<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengumumanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {

        return [
            'foto' => 'required|file|mimes:jpg,jpeg,png|max:11512',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|max:10000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'foto.required' => 'Foto pengumuman harus diisi.',
            'foto.file' => 'Foto pengumuman harus berupa file.',
            'foto.mimes' => 'Format foto pengumuman harus jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto pengumuman maksimal 11MB.',
            'judul.required' => 'Judul pengumuman harus diisi.',
            'judul.string' => 'Judul pengumuman harus berupa string.',
            'judul.max' => 'Judul pengumuman maksimal 255 karakter.',
            'isi.required' => 'Konten pengumuman harus diisi.',
            'isi.string' => 'Konten pengumuman harus berupa string.',
            'isi.max' => 'Konten pengumuman maksimal 1000 karakter.',
        ];
    }
}
