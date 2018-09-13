<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'nullable|max:80',
            'avatar' => 'mime:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];

    }

    // custom error message to each rules above. Below it only write out name's rules
    public function messages()
    {
        return [
            'avatar.mimes' => 'type should be jpeg, bmp, png or gif',
            'avatar.dimensions' => 'width and height should be 200+',
            'name.unique' => 'username has been taken. ',
            'name.regex' => 'only support regex style. ',
            'name.between' => 'only support 3-25 characters.',
            'name.required' => 'cannot be empty. ',
        ];
    }
}
