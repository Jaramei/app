<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 22.06.2018
 * Time: 19:42
 */

namespace Application\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PackageRequest extends FormRequest
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
            'provider'=>'required|max:160|min:15',
            'controller'=>'required|min:3|max:50'
        ];


    }
}
