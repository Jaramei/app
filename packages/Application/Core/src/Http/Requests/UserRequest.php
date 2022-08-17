<?php

namespace Application\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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

    public function rules(Request $request)
    {


        return [
            'name' => 'required|unique:packages|max:120',
            'email' => 'required|email|unique:users,email,'.$request->segment(4).',id|max:120',
            'roles'=>'required'
        ];


    }
}
