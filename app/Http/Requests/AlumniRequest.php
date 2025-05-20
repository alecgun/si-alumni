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
        $alumniId = $this->route('alumnus') ? $this->route('alumnus')->id : null;

        $rules = [
            'nis' => 'required|string|max:10|unique:alumni,nis,',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'tahun_masuk' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'tanggal_lahir' => 'required|date',
            'instagram' => 'nullable|string|max:255',
            'sosmed_lain' => 'nullable|string|max:255',
            'id_user' => 'required|integer|exists:users,id|unique:alumni,id_user',
        ];

        if ($this->isMethod('put')) {
            $rules['nis'] = 'required|string|unique:alumni,nis,' . $alumniId;
            $rules['id_user'] = 'required|string|unique:alumni,id_user,' . $alumniId;
        }

        return $rules;
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
            'tanggal_lahir.date' => 'Tanggal lahir harus sah',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'instagram.string' => 'Instagram harus berupa teks',
            'instagram.max' => 'Instagram maksimal 255 karakter',
            'sosmed_lain.string' => 'Sosmed lain harus berupa teks',
            'sosmed_lain.max' => 'Sosmed lain maksimal 255 karakter',
            'id_user.required' => 'ID pengguna harus diisi',
            'id_user.integer' => 'ID pengguna harus berupa angka',
            'id_user.exists' => 'ID pengguna tidak ditemukan',
            'id_user.unique' => 'ID pengguna sudah digunakan',
        ];
    }
}
