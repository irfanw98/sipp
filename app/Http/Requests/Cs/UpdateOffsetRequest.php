<?php

namespace App\Http\Requests\Cs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOffsetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_nota' => 'required|unique:offsets,no_nota,'.$this->id,
            'nama_konsumen' => 'required',
            'jenis_bahan' => 'required',
            'jenis_mesin' => 'required',
            'qty' => 'required',
            'nama_file' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'no_nota.required' => 'nomor nota wajib diisi.',
            'no_nota.unique' => 'nomor nota sudah digunakan.',
            'nama_konsumen.required' => 'nama konsumen wajib diisi.',
            'jenis_bahan.required' => 'jenis bahan wajib diisi.',
            'jenis_mesin.required' => 'jenis mesin wajib diisi.',
            'qty.required' => 'qty wajib diisi.',
            'nama_file.required' => 'nama file wajib diisi.',
        ];
    }
}