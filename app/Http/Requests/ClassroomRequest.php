<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
        $id = isset($this->classroom) ? $this->classroom->id : '';

        $rules = [
            'code' => 'required|min:6|max:6|regex:/^[A-Z]{2}[0-9]{4}$/|unique:classrooms,code,' . $id,
            'name' => 'required|min:2|max:140|regex:/^([A-Za-z0-9\s\.:\-_()])+$/',
            'year' => 'required|digits:1',
            'semester' => 'required|digits:1',
            'floor' => 'required|digits_between:1,2',
            'room' => 'required|digits_between:1,2',
            'capacity' => 'required|digits_between:1,3'
        ];

        return $rules;
    }
}
