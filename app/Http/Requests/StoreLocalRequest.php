<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max=255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'imagem' => 'nullable|image|max:2048',
        ];
    }
}
