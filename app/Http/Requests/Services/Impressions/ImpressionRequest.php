<?php

namespace App\Http\Requests\Services\Impressions;

use Illuminate\Foundation\Http\FormRequest;

class ImpressionRequest extends FormRequest
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
//        return [];
        return [
            'event_name'=> 'required',
            'data' => 'required',
        ];
    }
}
