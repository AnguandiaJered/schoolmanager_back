<?php

namespace Modules\Eleve\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Eleve\App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inscription = Inscription::with(['eleve','classe','annee','paiement'])->orderBy('id','desc')->paginate(10);
        return $this->sendData($inscription);
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
    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required',
            'classe_id' => 'required',
            'annee_id' => 'required',
            'paiement_id' => 'required'
        ]);

        try {
            $inscription = new Inscription();
            $inscription->eleve_id = $request->input('eleve_id');
            $inscription->classe_id = $request->input('classe_id');
            $inscription->annee_id = $request->input('annee_id');
            $inscription->paiement_id = $request->input('paiement_id');
            $inscription->author = Auth::user()->id;

            $inscription->save();

            return $this->sendResponse($inscription, 'Enregistrement réussi');
        } catch (\Throwable $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $inscription = Inscription::findOrFail($id);
        return $this->sendData($inscription);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inscription = Inscription::findOrFail($id);
        return $this->sendData($inscription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'eleve_id' => 'sometimes|integer',
            'classe_id' => 'sometimes|integer',
            'annee_id' => 'sometimes|integer',
            'paiement_id' => 'sometimes|integer',
            'author' => 'sometimes|integer'
        ]);

        try {
            $inscription = Inscription::findOrFail($id);

            $inscription->eleve_id = $request->input('eleve_id');
            $inscription->classe_id = $request->input('classe_id');
            $inscription->annee_id = $request->input('annee_id');
            $inscription->paiement_id = $request->input('paiement_id');
            $inscription->author = Auth::user()->id;

            $inscription->save();

            return $this->sendResponse($inscription, 'Modification réussi');
        } catch (\Throwable $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Inscription::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
