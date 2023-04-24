<?php

namespace App\Http\Requests;

use App\Models\Farm;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $farm = $this->route('farm');

        return $farm && $farm->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'email' => 'email|nullable',
            'website' => 'url|nullable',
        ];
    }
}
