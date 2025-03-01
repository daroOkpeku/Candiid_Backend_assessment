<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditIdtaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id"=>"required|integer",
            'title'=>"required|string",
            'description'=>"string|nullable",
            'status'=>"required|string",
           'due_date'=>"required|string"
        ];
    }
}
