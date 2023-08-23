<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreMediasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        return $request->user()->role == User::IS_BURSA;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tanggal_waktu' => ['required', 'string'],
            'tempat' => ['required', 'string'],
            'link_pertemuan' => ['string'],
            'file_undangan' => ['mimes:jpeg,pdf,jpg,png']
        ];
    }
}
