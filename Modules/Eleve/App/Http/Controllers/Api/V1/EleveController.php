<?php

namespace Modules\Eleve\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Eleve\App\Models\Eleve;
use Modules\Eleve\App\Http\Requests\EleveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EleveController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eleve = Eleve::latest()->get();
        return $this->sendData($eleve);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eleve::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EleveRequest $request)
    {
        try {
            if(!is_null($request->image)){

                $new_name = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('/storage/eleve'), $new_name);

                $eleve = new Eleve();

                $eleve->matricule = $request->input('matricule');
                $eleve->nom = $request->input('nom');
                $eleve->postnom = $request->input('postnom');
                $eleve->prenom = $request->input('prenom');
                $eleve->sexe = $request->input('sexe');
                $eleve->datenaiss = $request->input('datenaiss');
                $eleve->lieunaiss = $request->input('lieunaiss');
                $eleve->adresse = $request->input('adresse');
                $eleve->etatcivil = $request->input('etatcivil');
                $eleve->nationalite = $request->input('nationalite');
                $eleve->nomtutaire = $request->input('nomtutaire');
                $eleve->professiontutaire = $request->input('professiontutaire');
                $eleve->phonetutaire = $request->input('phonetutaire');
                $eleve->image = $new_name;
                $eleve->author = Auth::user()->id;

                $eleve->save();
            }

            return $this->sendResponse($eleve, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $eleve = Eleve::findOrFail($id);
        return $this->sendData($eleve);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $eleve = Eleve::findOrFail($id);
        return $this->sendData($eleve);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'matricule' => 'sometimes|string',
            'nom' => 'sometimes|string',
            'postnom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'sexe' => 'sometimes|string',
            'datenaiss' => 'sometimes|string',
            'lieunaiss' => 'sometimes|string',
            'adresse' => 'sometimes|string',
            'etatcivil' => 'sometimes|string',
            'nationalite' => 'sometimes|string',
            'nomtutaire' => 'sometimes|string',
            'professiontutaire' => 'sometimes|string',
            'phonetutaire' => 'sometimes|string',
            'author' => 'sometimes|string'
        ]);

        $payload = [];
        if($request->hasFile('image')){
            $new_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/storage/eleve'),$new_name);

            $payload = array_merge($payload, [
                'image' => $new_name
            ]);
        }

        $eleve = Eleve::findOrFail($id);
        if($eleve){
            $payload = array_merge($payload, $request->except(['image']));

            $eleve->update($payload);

            return $this->sendResponse($eleve,'Modification réussi');

        }else{
            return $this->sendErrorResponse('Erreur de modification!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Eleve::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
