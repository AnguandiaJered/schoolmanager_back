<?php

namespace Modules\Personnel\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Personnel\App\Models\Enseignant;
use Modules\Personnel\App\Http\Requests\EnseignantRequest;
use Illuminate\Support\Facades\Storage;

class EnseignantController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignant = Enseignant::latest()->get();
        return $this->sendData($enseignant);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personnel::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnseignantRequest $request)
    {
        try {
            if(!is_null($request->image)){

                $new_name = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('/storage/enseignant'), $new_name);

                $matricule = $this->generateOptmatr(14);

                $enseignant = new Enseignant();

                $enseignant->matricule = $matricule;
                $enseignant->noms = $request->input('noms');
                $enseignant->sexe = $request->input('sexe');
                $enseignant->datenaiss = $request->input('datenaiss');
                $enseignant->lieunaiss = $request->input('lieunaiss');
                $enseignant->adresse = $request->input('adresse');
                $enseignant->etatcivil = $request->input('etatcivil');
                $enseignant->nationalite = $request->input('nationalite');
                $enseignant->niveauEtude = $request->input('niveauEtude');
                $enseignant->mail = $request->input('mail');
                $enseignant->contact = $request->input('contact');
                $enseignant->grade = $request->input('grade');
                $enseignant->specialite = $request->input('specialite');
                $enseignant->finEtude = $request->input('finEtude');
                $enseignant->ecole = $request->input('ecole');
                $enseignant->image = $new_name;

                $enseignant->save();
            }

            return $this->sendResponse($enseignant, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return $this->sendData($enseignant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return $this->sendData($enseignant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'noms' => 'sometimes|string',
            'sexe' => 'sometimes|string',
            'datenaiss' => 'sometimes|string',
            'lieunaiss' => 'sometimes|string',
            'adresse' => 'sometimes|string',
            'etatcivil' => 'sometimes|string',
            'nationalite' => 'sometimes|string',
            'niveauEtude' => 'sometimes|string',
            'mail' => 'sometimes|string',
            'contact' => 'sometimes|string',
            'grade' => 'sometimes|string',
            'specialite' => 'sometimes|string',
            'finEtude' => 'sometimes|string',
            'ecole' => 'sometimes|string'
        ]);

        $payload = [];
        if($request->hasFile('image')){
            $new_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/storage/enseignant'),$new_name);

            $payload = array_merge($payload, [
                'image' => $new_name
            ]);
        }

        $enseignant = Enseignant::findOrFail($id);
        if($enseignant){
            $payload = array_merge($payload, $request->except(['image']));

            $enseignant->update($payload);

            return $this->sendResponse($enseignant,'Modification réussi');

        }else{
            return $this->sendErrorResponse('Erreur de modification!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Enseignant::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
