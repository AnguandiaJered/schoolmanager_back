<?php

namespace Modules\Frais\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Frais\App\Models\Frais;
use App\Traits\JsonResponseTrait;

class FraisController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frais = Frais::latest()->get();
        return $this->sendData($frais);
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
            'designation' => 'required'
        ]);

        try {
            $frais = new Frais();

            $frais->designation = $request->input('designation');
            $frais->save();

            return $this->sendResponse($frais, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $frais = Frais::findOrFail($id);
        return $this->sendData($frais);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $frais = Frais::findOrFail($id);
        return $this->sendData($frais);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'designation' => 'sometimes|string'
        ]);

        try {
            $frais = Frais::findOrFail($id);

            $frais->designation = $request->input('designation');
            $frais->save();

            return $this->sendResponse($frais, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Frais::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
