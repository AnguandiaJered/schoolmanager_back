<?php

namespace Modules\Eleve\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'matricule' => 'required',
            'nom' => 'required',
            'postnom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'datenaiss' => 'required',
            'lieunaiss' => 'required',
            'adresse' => 'required',
            'etatcivil' => 'required',
            'nationalite' => 'required',
            'nomtutaire' => 'required',
            'professiontutaire' => 'required',
            'phonetutaire' => 'required'
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
