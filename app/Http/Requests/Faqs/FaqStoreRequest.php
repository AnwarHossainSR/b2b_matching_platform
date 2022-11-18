<?php

namespace App\Http\Requests\Faqs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class FaqStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('faq-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'question' => [
                'required',
                'string',
                'unique:' . config('constants.table.faqs') . ',question',
            ],
            'answer' => [
                'required',
                'string',
            ]
        ];
    }
}
