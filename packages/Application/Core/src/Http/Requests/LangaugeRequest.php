<?php


namespace Application\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LangaugeRequest extends FormRequest
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
     */

    public function rules(Request $request)
    {

        return [
            'name' => 'required|max:120|min:3',
            'slug'=>'required|max:160|min:2',
        ];

    }
}