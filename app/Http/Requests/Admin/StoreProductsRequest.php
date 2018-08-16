<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'category.*' => 'exists:product_categories,id',
            'tag.*' => 'exists:product_tags,id',
            'photo1' => 'nullable|mimes:png,jpg,jpeg,gif',
            'photo2' => 'nullable|mimes:png,jpg,jpeg,gif',
            'photo3' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
