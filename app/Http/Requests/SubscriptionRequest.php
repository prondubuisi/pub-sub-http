<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SubscriptionRequest extends FormRequest
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
            'url' => 'required|string|unique:subscriptions,callback_url'
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
            'topic.required' => 'Please provide the topic you want to suscribe to',
            'url.required' => 'Please provide the callback url for topic',
            'url.unique' => 'Specified url has already been subscribed to a topic'
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
