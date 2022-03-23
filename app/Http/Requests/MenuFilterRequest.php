<?php

namespace App\Http\Requests;

use App\Traits\ResponseApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class MenuFilterRequest extends FormRequest
{

    use ResponseApi;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "expires_at_operand" => ["string", "in:>=,<=,>,<,=,!="],
            "stock_operand" => ["string", "in:>=,<=,>,<,=,!="],
            "expires_at" => ["date"],
            "stock" => ["numeric"],
        ];
    }

    /**
     * if validation failed return response
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->fail(
                $validator->errors()->all(),
                422
            )
        );
    }
}
