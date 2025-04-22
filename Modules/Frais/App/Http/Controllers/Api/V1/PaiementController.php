<?php

namespace Modules\Frais\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Frais\App\Models\Paiement;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiement = Paiement::with('eleve','frais','author')->paginate(5);
        return $this->sendData($paiement);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frais::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required',
            'libelle' => 'required',
            'eleve_id' => 'required',
            'frais_id' => 'required',
        ]);

        try {
            $paiement = new Paiement();

            $paiement->montant = $request->input('montant');
            $paiement->libelle = $request->input('libelle');
            $paiement->eleve_id = $request->input('eleve_id');
            $paiement->frais_id = $request->input('frais_id');
            $paiement->author = Auth::user()->id;
            $paiement->save();

            return $this->sendResponse($paiement, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $paiement = Paiement::findOrFail($id);
        return $this->sendData($paiement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        return $this->sendData($paiement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => 'sometimes|string',
            'libelle' => 'sometimes|string',
            'eleve_id' => 'sometimes|integer',
            'frais_id' => 'sometimes|integer',
        ]);

        try {
            $paiement = Paiement::findOrFail($id);

            $paiement->montant = $request->input('montant');
            $paiement->libelle = $request->input('libelle');
            $paiement->eleve_id = $request->input('eleve_id');
            $paiement->frais_id = $request->input('frais_id');
            $paiement->author = Auth::user()->id;
            $paiement->save();

            return $this->sendResponse($paiement, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Paiement::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
