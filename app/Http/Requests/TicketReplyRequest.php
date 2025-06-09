<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketReplyRequest extends FormRequest
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
            'reply_text' => 'required|string|max:255',
            'id_ticket' => 'nullable|exists:ticket,id',
            'id_user' => 'nullable|exists:users,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'reply_text.required' => 'Teks balasan harus diisi.',
            'reply_text.string' => 'Teks balasan tiket harus berupa string.',
            'reply_text.max' => 'Teks balasan maksimal 255 karakter.',
            'id_ticket.exists' => 'Tiket yang dipilih tidak valid.',
            'id_user.exists' => 'Pengguna yang dipilih tidak valid.',
        ];
    }
}
