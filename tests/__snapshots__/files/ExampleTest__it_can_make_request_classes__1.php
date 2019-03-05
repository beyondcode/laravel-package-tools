<?php

namespace BeyondCode\LaravelPackageTools\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExampleTest__it_can_make_request_classes__1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
