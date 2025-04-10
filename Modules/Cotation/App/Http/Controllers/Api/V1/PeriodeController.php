<?php

namespace Modules\Cotation\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;
use Modules\Cotation\App\Models\Periode;

class PeriodeController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periode = Periode::latest()->get();
        return $this->sendData($periode);
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
            'designation' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        try {
            $periode = new Periode();

            $periode->designation = $request->input('designation');
            $periode->date_debut = $request->input('date_debut');
            $periode->date_fin = $request->input('date_fin');
            $periode->author = Auth::user()->id;
            $periode->save();

            return $this->sendResponse($periode, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $periode = Periode::findOrFail($id);
        return $this->sendData($periode);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periode = Periode::findOrFail($id);
        return $this->sendData($periode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'designation' => 'sometimes|string',
            'date_debut' => 'sometimes|string',
            'date_fin' => 'sometimes|string',
        ]);

        try {
            $periode = Periode::findOrFail($id);

            $periode->designation = $request->input('designation');
            $periode->date_debut = $request->input('date_debut');
            $periode->date_fin = $request->input('date_fin');
            $periode->author = Auth::user()->id;
            $periode->save();

            return $this->sendResponse($periode, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Periode::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
