<?php

namespace Modules\Eleve\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Eleve\App\Models\Classe;

class ClasseController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classe=Classe::latest()->get();
        return $this->sendData($classe);
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
            $classe = new Classe();
            $classe->designation=$request->input('designation');
            $classe->save();

            return $this->sendResponse($classe,'Enregistrement réussi');
        } catch (\Throwable $e) {
            return $this->sendErrorResponse('Echec d\'enregistrement', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $classe = Classe::findOrFail($id);
        return $this->sendData($classe);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classe = Classe::findOrFail($id);
        return $this->sendData($classe);
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
            $classe = Classe::findOrFail($id);
            $classe->designation=$request->input('designation');
            $classe->save();

            return $this->sendResponse($classe,'Modification réussi');
        } catch (\Throwable $e) {
            return $this->sendErrorResponse('Echec de modification', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Classe::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
