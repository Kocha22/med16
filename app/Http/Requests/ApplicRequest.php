<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicRequest extends FormRequest
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
            'tin' => 'required',
            'surname' => 'required', 
            'middle' => 'required',            
            'area_id' => 'required',
            'address' => 'required',
            'area_id2' => 'required',
            'address2' => 'required',
            'residential_address' => 'required', 
            'actual_address' => 'required', 
            'passport' => 'required',
            'country_id' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:applicants',
        ];
        
    }
}
