<?php

namespace Application\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductCategoriesRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        // Determine if the user is authorized to view the module.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array

     */

    public function rules()
    {

        switch ($this->method()) {

            case 'PUT':
            case 'PATCH':
                return [
                  //  'name' => 'required',
                    //    'body'=>'required|min:3',
                ];

            default:
                return [
                   // 'name' => 'required',
                    //   'body'=>'required|min:3',
                    // 'upload'=>'required|image|mimes:jpeg,jpg,bmp,png|max:8000'
                ];
        }


    }
}
