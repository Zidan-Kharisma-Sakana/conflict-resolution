<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StorePengaduanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        return $request->user()->role == User::IS_NASABAH;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "terlapor.company.id" => ['required'],
            'terlapor.company.cabang' => ['required', 'string'],
            "terlapor.*.*" => [''],
            "pertanyaan.kuasa.*" => ['required', 'string'],
            "pertanyaan.broker.*" => ['required', 'string'],
            "pertanyaan.exchange.*" => ['required', 'string'],
            "pertanyaan.legal.*" => ['required', 'string'],
            "kronologi.description" => ['required', 'string'],
            "kerugian" => ['required', 'string'],
            "documents.ktp" => ['required', 'mimes:jpeg,pdf,jpg,png'],
            "documents.transfer" => ['required', 'mimes:jpeg,pdf,jpg,png'],
            "documents.pendukung" => ['mimes:jpeg,pdf,jpg,png'],
            "documents.kuasa" => ['mimes:jpeg,pdf,jpg,png'],
            "kronologi.description" => ['required', 'string'],
            "documents.lampiran" => ['mimes:jpeg,pdf,jpg,png'],
        ];
    }
}
