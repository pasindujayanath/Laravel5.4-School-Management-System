<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
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
            'experience' => 'required|digits_between:1, 2',
            'qualification' => 'required|min:2|max:100|regex:/^([A-Za-z0-9\s\.,:\-_()])+$/',
            'phone' => 'required|digits:10|regex:/^0(\d){9}$/',
            'address' => "required|min:2|max:200|regex:/^([A-Za-z\&\s\.,:\-_'0-9#])+$/"
        ];

        if (request()->isMethod('POST')) {   
            $rules['email'] = 'required|email|unique:instructors,email';
        } 

        return $rules;
    }
}
