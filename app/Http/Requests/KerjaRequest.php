<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KerjaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        if ($this->user()->can('kerja.create') || $this->user()->can('kerja.edit')) {
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
            'tempat_kerja' => 'required|string|max:255',
            'posisi_kerja' => 'required|string|max:50',
            'tahun_masuk' => 'required|integer|min:1900',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'tempat_kerja.required' => 'Tempat kerja harus diisi.',
            'tempat_kerja.string' => 'Tempat kerja harus berupa string.',
            'tempat_kerja.max' => 'Tempat kerja maksimal 255 karakter.',
            'posisi_kerja.required' => 'Posisi kerja harus diisi.',
            'posisi_kerja.string' => 'Posisi kerja harus berupa string.',
            'posisi_kerja.max' => 'Posisi kerja maksimal 50 karakter.',
            'tahun_masuk.required' => 'Tahun masuk harus diisi.',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa integer.',
            'tahun_masuk.min' => 'Tahun masuk minimal 1900.',

        ];
    }
}
