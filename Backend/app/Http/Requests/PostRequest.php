<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;



class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //    return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $method = $this->method();



        switch ($method) {
            case 'POST':
                return [
                    'user_id' => 'required|integer|exists:users,id',
                    'title' => 'required|string',
                    'content' => 'required|string',
                ];
            case 'PUT':
                return [
                    'user_id' => 'integer',
                    'title' => 'string',
                    'content' => 'string',
                ];
            default:
                return [];
        }

    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required',
            'user_id.integer' => 'User ID must be an integer',
            'user_id.exists' => 'User ID does not exist',
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST));
    }

}
