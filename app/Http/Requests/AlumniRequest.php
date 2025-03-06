<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumniRequest extends FormRequest
{
    /**
     * Determine if the alumni is authorized to make this request.
     */
    public function authorize()
    {
        if ($this->user()->can('alumni.create') || $this->user()->can('alumni.edit')) {
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
        $alumniId = $this->route('alumni') ? $this->route('alumni')->id : null;

        return [
            'nis' => 'required|string|max:10|unique:alumni,nis,' . $alumniId,
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'tahun_masuk' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'instagram' => 'nullable|string|max:255',
            'sosmed_lain' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'nis.required' => 'NIS harus diisi',
            'nis.string' => 'NIS harus berupa teks',
            'nis.max' => 'NIS maksimal 10 karakter',
            'nis.unique' => 'NIS sudah digunakan',
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.max' => 'Nama maksimal 255 karakter',
            'kelas.required' => 'Kelas harus diisi',
            'kelas.string' => 'Kelas harus berupa teks',
            'kelas.max' => 'Kelas maksimal 10 karakter',
            'tahun_masuk.required' => 'Tahun masuk harus diisi',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka',
            'tahun_masuk.min' => 'Tahun masuk minimal 1900',
            'tahun_masuk.max' => 'Tahun masuk maximal ' . (date('Y') + 1),
            'tahun_lulus.required' => 'Tahun lulus harus diisi',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka',
            'tahun_lulus.min' => 'Tahun lulus minimal 1900',
            'tahun_lulus.max' => 'Tahun lulus maximal ' . (date('Y') + 1),
            'instagram.string' => 'Instagram harus berupa teks',
            'instagram.max' => 'Instagram maksimal 255 karakter',
            'sosmed_lain.string' => 'Sosmed lain harus berupa teks',
            'sosmed_lain.max' => 'Sosmed lain maksimal 255 karakter',
        ];
    }
}
