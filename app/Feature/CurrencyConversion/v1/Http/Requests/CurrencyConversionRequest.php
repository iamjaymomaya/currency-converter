<?php

namespace App\Feature\CurrencyConversion\v1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CurrencyConversionRequest extends FormRequest
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
        return [
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required|numeric|min:0.1'
        ];
    }

    public function getCacheKeyTitle() {
        $user = Auth::user();
        return $user->id."_".$this->from."_".$this->amount."_".$this->to;
    }
}
