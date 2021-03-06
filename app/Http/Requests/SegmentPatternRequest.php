<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class SegmentPatternRequest extends Request
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
            'strSegPName' => 'unique_with:tblSegmentPattern,strSegPStyleCategoryFK',
            'addImg' => 'image',
            'dblPatternPrice' => 'required|numeric'
            
        ];
    }

    public function messages()
    {
        return [
            'strSegPName.unique_with'  =>  'Pattern already exists.',
            // 'strSegPName.required'  =>  'Pattern name is required.',
            'addImg.image' => 'The file you uploaded is not an image.',
            'dblPatternPrice.numeric' => 'Pattern price should be numeric',
            'dblPatternPrice.required' => 'Pattern price is required.'
            
            
        ];

    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();

    }
}
