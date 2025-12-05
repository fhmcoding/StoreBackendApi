<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=> ['string','required','max:200','min:3'],
            'description' => ['string','required','min:3'],
            // 'price'=> ['numeric','between:0,9999999999.99','required'],
            // 'sale_price'=> ['numeric','between:0,9999999999.99','required'],
            // 'stock_quantity' => ['numeric','between:0,9999999999','required'],
            'is_active' => ['boolean','boolean','nullable'],
            'category_id'=>['required','exists:categories,id'],
            'brand_id'=>['required','exists:brands,id'],
        ];
    }
}
