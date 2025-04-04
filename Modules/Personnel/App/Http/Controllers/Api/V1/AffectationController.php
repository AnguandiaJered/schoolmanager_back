<?php

namespace Modules\Personnel\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Personnel\App\Models\Affectation;
use Illuminate\Support\Facades\Auth;

class AffectationController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affectation=Affectation::with('enseignant','annee','classe','author')->paginate(5);
        return $this->sendData($affectation);
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
    public function store(Request $request)
    {
        $request->validate([
            'enseignant_id' => 'required',
            'classe_id' => 'required',
            'annee_id' => 'required',
        ]);

        try {
            $affectation=new Affectation();

            $affectation->enseignant_id=$request->input('enseignant_id');
            $affectation->classe_id=$request->input('classe_id');
            $affectation->annee_id=$request->input('annee_id');
            $affectation->author = Auth::user()->id;

            $affectation->save();

            return $this->sendResponse($affectation, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $affectation=Affectation::findOrFail($id);
        return $this->sendData($affectation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $affectation=Affectation::findOrFail($id);
        return $this->sendData($affectation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'enseignant_id' => 'sometimes|integer',
            'classe_id' => 'sometimes|integer',
            'annee_id' => 'sometimes|integer',
        ]);

        try {
            $affectation=Affectation::findOrFail($id);

            $affectation->enseignant_id=$request->input('enseignant_id');
            $affectation->classe_id=$request->input('classe_id');
            $affectation->annee_id=$request->input('annee_id');
            $affectation->author = Auth::user()->id;

            $affectation->save();

            return $this->sendResponse($affectation, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Affectation::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
