<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdCreateRequest extends FormRequest
{
    protected $redirect;


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
        $this->redirect = url()->previous();
        return [
            'name' => 'required|max:200',
            'description' => 'required | max:10000',
            'price' => 'required|numeric',
            'location' => 'nullable',
            'images' => 'array|max:10',
            //'images.*' => 'image | mimes:jpg,jpeg,webp,png,JPG,JPEG,WEBP,PNG | max:5120',
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => ['regex:/^\+?[0-9]{0,14}$/', 'nullable', 'unique:App\User,phone'],
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
