<?php

namespace Modules\Frais\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Frais\App\Models\Prevision;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;

class PrevisionController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prevision = Prevision::with('annee','classe','frais','author')->paginate(5);
        return $this->sendData($prevision);
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
            'annee_id' => 'required',
            'classe_id' => 'required',
            'frais_id' => 'required',
        ]);

        try {
            $prevision = new Prevision();

            $prevision->montant = $request->input('montant');
            $prevision->annee_id = $request->input('annee_id');
            $prevision->classe_id = $request->input('classe_id');
            $prevision->frais_id = $request->input('frais_id');
            $prevision->author = Auth::user()->id;

            $prevision->save();

            return $this->sendResponse($prevision, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $prevision = Prevision::findOrFail($id);
        return $this->sendData($prevision);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prevision = Prevision::findOrFail($id);
        return $this->sendData($prevision);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => 'sometimes|integer',
            'annee_id' => 'sometimes|integer',
            'classe_id' => 'sometimes|integer',
            'frais_id' => 'sometimes|integer',
        ]);

        try {
            $prevision = Prevision::findOrFail($id);

            $prevision->montant = $request->input('montant');
            $prevision->annee_id = $request->input('annee_id');
            $prevision->classe_id = $request->input('classe_id');
            $prevision->frais_id = $request->input('frais_id');
            $prevision->author = Auth::user()->id;

            $prevision->save();

            return $this->sendResponse($prevision, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Prevision::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
