<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        return [
            'name' => 'min:3|max:100|unique:products,name,' . $this->route('product')->id,
            'code' => 'min:1|max:100|unique:products,code,' . $this->route('product')->id,
            'size' => 'max:255',
            'quantity' => 'numeric',
            'composition' => 'max:255'
        ];
    }
}
