<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PublicationRequest extends FormRequest
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
            'topic' => 'required|string',
            'message' => 'required|string'
        ];
    }

    /**
     * Get the custom validation error messages.
     *
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'topic.required' => 'Please provide the topic you want to publish to',
            'url.required' => 'Please provide a message for subscribers',   
        ];
    }

    /**
     * Add route parameter to validated data array
     *
     * @return array
     */
    public function validationData(){
        return array_merge($this->all(),$this->route()->parameters());
    }

    /**
     * Return validation errors as json
     *
     * @return Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
