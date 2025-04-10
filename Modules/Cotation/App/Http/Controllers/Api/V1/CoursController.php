<?php

namespace Modules\Cotation\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Cotation\App\Models\Cours;
use App\Traits\JsonResponseTrait;

class CoursController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::latest()->get();
        return $this->sendData($cours);
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
            'designation' => 'required'
        ]);

        try {
            $cours = new Cours();

            $cours->designation = $request->input('designation');
            $cours->save();

            return $this->sendResponse($cours, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $cours = Cours::findOrFail($id);
        return $this->sendData($cours);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cours = Cours::findOrFail($id);
        return $this->sendData($cours);
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
            $cours = Cours::findOrFail($id);

            $cours->designation = $request->input('designation');
            $cours->save();

            return $this->sendResponse($cours, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cours::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
