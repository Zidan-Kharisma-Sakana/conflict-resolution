<?php

namespace App\Http\Requests;

use App\Models\Profile\Nasabah;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatenasabahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request, Nasabah $nasabah): bool
    {
        if($request->user()->role !== User::IS_NASABAH){
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "pekerjaan" => ['string', 'required'],
            "jabatan" => ['string', 'required'],
            "alamat" => ['string', 'required'],
            "provinsi" => ['string', 'required'],
            "kota_kabupaten" => ['string', 'required'],
            "tempat_lahir" => ['string', 'required'],
            "tanggal_lahir" => ['date', 'required'],
            "identitas" => ['string', 'required'],
            "nomor_identitas" => ['string', 'required'],
            "gender" => ['string', 'required'],
            "nomor_hp" => ['string', 'required'],
        ];
    }
}
