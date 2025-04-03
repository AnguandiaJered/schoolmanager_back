<?php

namespace Modules\Personnel\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnseignantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'matricule' => 'required',
            'noms' => 'required',
            'sexe' => 'required',
            'datenaiss' => 'required',
            'lieunaiss' => 'required',
            'adresse' => 'required',
            'etatcivil' => 'required',
            'nationalite' => 'required',
            'niveauEtude' => 'required',
            'mail' => 'required',
            'contact' => 'required',
            'grade' => 'required',
            'specialite' => 'required',
            'finEtude' => 'required',
            'ecole' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
