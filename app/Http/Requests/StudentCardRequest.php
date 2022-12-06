<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentCardRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user.surname' => 'required',
            'user.first_name' => 'required',
            'user.middle_name' => 'required',
            'user.sex' => ['required', Rule::in(['male', 'female'])],
            'user.birthday' => 'required|date',
            'user.citizenship' => 'required',
            'user.job' => 'nullable',
            'user.phone_number' => 'nullable',
            'student.home_phone_number' => 'nullable',
            'student.graduated' => 'required',
            'student.relationship' => 'nullable',
            'student.hobbies' => 'nullable',
            'student.address' => 'nullable',
            'student.health' => 'required',
            'student.social_conditions' => 'nullable',
            'student.apprenticeship' => 'required',
            'student.certificate_date' => 'required|date',
            'student.other_details' => 'nullable',
            'address.region' => 'required',
            'address.district' => 'required',
            'address.residenceType' => 'required',
            'address.residence' => 'required',
            'address.street' => 'required',
            'passport.series' => 'required',
            'passport.number' => 'required',
            'passport.district_department' => 'required',
            'passport.issue_date' => 'required|date',
        ];
    }
}
