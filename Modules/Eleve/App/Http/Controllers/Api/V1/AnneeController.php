<?php

namespace Modules\Eleve\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Eleve\App\Models\Annee;

class AnneeController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annee = Annee::latest()->get();
        return $this->sendData($annee);
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
            'designation'=>'required'
        ]);

        try {
            $annee = new Annee();
            $annee->designation = $request->input('designation');
            $annee->save();

            return $this->sendResponse($annee,'Enregistrement réussi');
        } catch (\Throwable $e) {
            return $this->sendErrorResponse('Echec d\'enregistrement', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $annee = Annee::findOrFail($id);
        return $this->sendData($annee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $annee = Annee::findOrFail($id);
        return $this->sendData($annee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'designation'=>'sometimes|string'
        ]);

        try {
            $annee = Annee::findOrFail($id);
            $annee->designation = $request->input('designation');
            $annee->save();

            return $this->sendResponse($annee,'Modification réussi');
        } catch (\Throwable $e) {
            return $this->sendErrorResponse('Echec de modification', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Annee::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
