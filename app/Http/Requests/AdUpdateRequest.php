<?php

namespace App\Http\Requests;

use App\Ad;
use Illuminate\Foundation\Http\FormRequest;

class AdUpdateRequest extends FormRequest
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
        $ad = $this->ad;
        $this->redirect = $ad->getURL('edit');
        return [
            'name' => 'required|max:200',
            'description' => 'required | max:10000',
            'price' => 'required|numeric',
            'location' => 'required',
            'images' => 'array|max:10',
            //'images.*' => 'image | mimes:jpg,jpeg,webp,png,JPG,JPEG,WEBP,PNG | max:5120',
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => 'regex:/^\*?[0-9]{0,14}$/',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'location' => 'ubicación',
            'phone' => 'teléfono',
            'images' => 'imagenes',
            'images.*' => 'imagenes',
            'fullName' => 'nombre',
            'price' => 'precio'
        ];
    }
}
