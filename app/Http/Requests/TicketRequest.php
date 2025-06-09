<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'status_ticket' => 'required|in:Open,Closed',
            'kategori' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:1000',
            'email' => 'nullable|email|max:255',
            'alumni_id' => 'nullable|exists:alumni,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'judul.required' => 'Judul tiket harus diisi.',
            'judul.string' => 'Judul tiket harus berupa string.',
            'judul.max' => 'Judul tiket maksimal 255 karakter.',
            'status_ticket.required' => 'Status tiket harus dipilih.',
            'status_ticket.in' => 'Status tiket harus berupa open atau closed.',
            'kategori.required' => 'Kategori tiket harus dipilih.',
            'kategori.string' => 'Kategori tiket harus berupa string.',
            'kategori.max' => 'Kategori tiket maksimal 50 karakter.',
            'deskripsi.required' => 'Konten tiket harus diisi.',
            'deskripsi.string' => 'Konten tiket harus berupa string.',
            'deskripsi.max' => 'Konten tiket maksimal 1000 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'alumni_id.exists' => 'Alumni yang dipilih tidak valid.',
        ];
    }
}
