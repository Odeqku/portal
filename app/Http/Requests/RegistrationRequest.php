<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {   
        if(!(app('profile_service')->userProfile() === 'Admin')){
            return false;
        }
        // dd('hiiii');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // dd('Hiii');
        return [
                'name' => 'required',
                'point' => 'required',
                'lecturer_name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'telephone' => 'required',
                'level_name' => 'required',
                'status_name' => 'required',
                'department_name' => 'required',
                'faculty_name' => 'required',
                'image' => 'image|nullable|max:1999',
                'semester' => 'required',
        ];
    }

    public function messages()
{
    // dd('message');
    return [
        'name.required' => 'The name field is required.',
        'point.required' => 'The point is required',
        'lecturer_name.required' => 'The lecturer name is required',
        'telephone.required' => 'The telephone is required',
        'level_name.required' => 'The level_name is required',
        'status_name.required' => 'The status_name is required',
        'department_name.required' => 'The department_name is required',
        'faculty_name.required' => 'The faculty_name is required',
        'semester.required' => 'The semester is required',
        'email.required' => 'The email field is required.',
        
    ];
}

}
