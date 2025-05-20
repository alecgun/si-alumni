<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KuliahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        if ($this->user()->can('kuliah.create') || $this->user()->can('kuliah.edit')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {

        return [
            'nama_universitas' => 'required|string|max:255',
            'fakultas' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'jenjang' => 'required|string|max:50',
            'status_kuliah' => 'required|string|max:50|in:Aktif,Lulus,Non-Aktif,Drop Out',
            'jalur_masuk' => 'required|string|max:50',
            'tahun_masuk' => 'required|integer|min:1900',
            'tahun_lulus' => $this->input('status_kuliah') == 'Lulus' ? 'required|integer|min:' . ($this->input('tahun_masuk')) : 'nullable|integer|min:' . ($this->input('tahun_masuk')),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'nama_universitas.required' => 'Nama universitas harus diisi',
            'nama_universitas.string' => 'Nama universitas harus berupa teks',
            'nama_universitas.max' => 'Nama universitas maksimal 255 karakter',
            'fakultas.required' => 'Fakultas harus diisi',
            'fakultas.string' => 'Fakultas harus berupa teks',
            'fakultas.max' => 'Fakultas maksimal 100 karakter',
            'program_studi.required' => 'Program studi harus diisi',
            'program_studi.string' => 'Program studi harus berupa teks',
            'program_studi.max' => 'Program studi maksimal 100 karakter',
            'jenjang.required' => 'Jenjang harus diisi',
            'jenjang.string' => 'Jenjang harus berupa teks',
            'jenjang.max' => 'Jenjang maksimal 50 karakter',
            'status_kuliah.required' => 'Status kuliah harus diisi',
            'status_kuliah.string' => 'Status kuliah harus berupa teks',
            'status_kuliah.max' => 'Status kuliah maksimal 50 karakter',
            'jalur_masuk.required' => 'Jalur masuk harus diisi',
            'jalur_masuk.string' => 'Jalur masuk harus berupa teks',
            'jalur_masuk.max' => 'Jalur masuk maksimal 50 karakter',
            'tahun_masuk.required' => 'Tahun masuk harus diisi',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka',
            'tahun_masuk.min' => 'Tahun masuk minimal 1900',
            'tahun_lulus.required' => 'Tahun lulus harus diisi',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka',
            'tahun_lulus.min' => 'Tahun lulus tidak boleh kurang dari tahun masuk',
        ];
    }
}
