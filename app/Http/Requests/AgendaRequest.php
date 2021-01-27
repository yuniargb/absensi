<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
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
        $rules = [
            'tgl_absen' => 'required',
            'nip' => 'required',
            'minggu' => 'required',
            'bulan' => 'required',
            'jam' => 'required',
            'materi' => 'required',
            'kegiatan' => 'required',
            'tipe' => 'required',
            'mapel' => 'required',
        ];
        return $rules;
    }
    public function attributes()
    {
        return [
            'tgl_absen' => 'tanggal absen',
            'tipe' => 'wajjib siswa',
            'mapel' => 'mata pelajaran',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute ini wajib diisi',
            'image' => ':attribute ini wajib gambar',
            'numeric' => ':attribute harus angka',
            'mimes' => ':attribute harus berupa doc,docx,pdf',
            'min' => ':attribute minimal 4'
        ];
    }
}
