<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:3000'],
            'is_public' => ['required', 'boolean'],
            'category_id' => ['required', 'nullable', 'integer', function($attribute, $value, $fail) {
                if($value !== 0 && !Category::where('user_id', auth()->id())->whereId($value)->first()){
                    return $fail(__('No category found'));
                }
            }]
        ];
    }
}
