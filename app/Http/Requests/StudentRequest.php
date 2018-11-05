<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $rules = [
            'f_name' => 'required|min:2|max:40|regex:/^([A-Za-z])+$/',
            'l_name' => 'required|min:2|max:40|regex:/^([A-Za-z])+$/',
            'initials' => 'required|min:2|max:16|regex:/^([A-Z]\.)+$/',
            'init_in_full' => 'required|min:2|max:140|regex:/^([A-Za-z\s])+$/',
            'dob' => 'required|date|date_format:Y-m-d',
            'phone' => 'required|digits:10|regex:/^0(\d){9}$/',
            'address' => "required|min:2|max:200|regex:/^([A-Za-z\&\s\.,:\-_'0-9#])+$/",
            'guardian_name' => 'required|min:2|max:140|regex:/^([A-Za-z\.\s])+$/',
            'guardian_phone' => 'required|digits:10|regex:/^0(\d){9}$/'
        ];

        if (request()->isMethod('POST')) {   
            $rules['email'] = 'required|email|unique:students,email';
        }    

        return $rules;
    }
}
