<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'nom']),
            'email.required' => __('validation.required', ['attribute' => 'email']),
            'email.email' => __('validation.email'),
            'subject.required' => __('validation.required', ['attribute' => 'sujet']),
            'message.required' => __('validation.required', ['attribute' => 'message']),
        ];
    }
}
