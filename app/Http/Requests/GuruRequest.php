<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nip' => 'required|unique:gurus,nip',
            'nama' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Filed ini wajib diisi',
            'unique' => 'NIP sudah dipakai'
        ];
    }
}
