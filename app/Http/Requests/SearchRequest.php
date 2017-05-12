<?php

namespace App\Http\Requests;

use App\Food2ForkClient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ingredients' => 'required|array',
            'page'        => 'integer',
            'sort'        => Rule::in([Food2ForkClient::SORT_RATING, Food2ForkClient::SORT_TRENDINGNESS]),
        ];
    }
}
