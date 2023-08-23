<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreKesepakatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        return $request->user()->role == User::IS_BURSA  || $request->user()->role == User::IS_PIALANG;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'kesepakatan.isi' => ['required', 'string'],
            'kesepakatan.file' => ['mimes:jpeg,pdf,jpg,png']
        ];
    }
}
