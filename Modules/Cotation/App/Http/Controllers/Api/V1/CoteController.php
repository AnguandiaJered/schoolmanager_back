<?php

namespace Modules\Cotation\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;
use Modules\Cotation\App\Models\Cotation;

class CoteController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cotation = Cotation::with('eleve','period','cours','user')->paginate(5);
        return $this->sendData($cotation);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cotation::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required',
            'period_id' => 'required',
            'cours_id' => 'required',
            'cote' => 'required',
        ]);

        try {
            $cotation = new Cotation();
        
            $cotation->eleve_id = $request->input('eleve_id');
            $cotation->period_id = $request->input('period_id');
            $cotation->cours_id = $request->input('cours_id');
            $cotation->cote = $request->input('cote');
            $cotation->author = Auth::user()->id;
            $cotation->save();

            return $this->sendResponse($cotation, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $cotation = Cotation::findOrFail($id);
        return $this->sendData($cotation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cotation = Cotation::findOrFail($id);
        return $this->sendData($cotation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'eleve_id' => 'sometimes|integer',
            'period_id' => 'sometimes|integer',
            'cours_id' => 'sometimes|integer',
            'cote' => 'sometimes|integer',
        ]);

        try {
            $cotation = Cotation::findOrFail($id);
        
            $cotation->eleve_id = $request->input('eleve_id');
            $cotation->period_id = $request->input('period_id');
            $cotation->cours_id = $request->input('cours_id');
            $cotation->cote = $request->input('cote');
            $cotation->author = Auth::user()->id;
            $cotation->save();

            return $this->sendResponse($cotation, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cotation::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
