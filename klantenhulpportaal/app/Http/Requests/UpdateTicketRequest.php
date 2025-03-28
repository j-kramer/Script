<?php

namespace App\Http\Requests;

use App\TicketStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => ['sometimes', Rule::enum(TicketStatus::class)],
            'categories' => 'nullable|exists:categories,id',
            'assignee_id' => ['nullable', Rule::exists('users', 'id')->where('is_admin', true)],
        ];
    }
}
