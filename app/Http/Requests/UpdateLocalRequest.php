<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|string',
            'longitude' => 'sometimes|string',
            'imagem' => 'nullable|image|max:2048',
        ];
    }
}
