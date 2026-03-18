<?php

namespace App\Http\Requests;



class UpdateAlbisteakRequest extends ApiFormRequest
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
            'izenburua' => 'required|string|max:255',
            'laburpena' => 'required|string|max:255',
            'xehetasunak' =>'required|string|max:255'
        ];
    }
    public function messages()
    {
        return [
            "izenburua.required" => 'izenburua es obligatorio',
            "izenburua.string" => 'izenburua karakteke kate bat izan behar da',
            "laburpena.required" => 'laburpena es obligatorio',
            "laburpena.string" => 'izenburua karakteke kate bat izan behar da',
            "xehetasunak.required" => 'xehetasunak es obligatorio',
            "xehetasunak.string" => 'xehetasunak karakteke kate bat izan behar da'
        ];
    }

}
