<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

public function authorize():bool
{
    return true;
}
    public function rules(): array
    {
        return [
            'slug'=>['string'],
            'picture'=>['required', 'string'],
            'name'=>['required', 'string', 'max:255'],
            'description'=>['required', 'string', 'max:800'],
            'weight'=>['required', 'string', 'max:5'],
            'stock'=>['required', 'string', 'max:10'],
            'TTC_price'=>['required','string', 'max:10'],
            'HT_price'=>['required', 'string', 'max:10'],
            'VAT'=>['required', 'string', 'max:5'],
            'category_id'=>['required', 'string'],
        ];
    }

}
