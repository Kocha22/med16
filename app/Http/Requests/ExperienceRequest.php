<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'organization_id' => 'required',
            'position_id' => 'required',
            'jobdate' => 'required',            
            'termination' => 'required',
            'warrant' => 'required',            
            'begindate' => 'required',
            'enddate' => 'required'
        ];
    }
}
