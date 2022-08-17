<?php

namespace App\Http\Requests;

use App\Models\Facebook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFacebookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facebook_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
