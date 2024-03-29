<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
//        dd($this->request->all());
        return [
            'title' => 'required|string',
            'description' => 'string',
            'assigned_user' => 'required|integer|exists:users,id',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,wip,completed'
        ];
    }
}
