<?php

namespace Modules\Cotation\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Cotation\App\Models\Mension;

class MensionController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mension = Mension::latest()->get();
        return $this->sendData($mension);
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
            $mension = new Mension();

            $mension->designation = $request->input('designation');
            $mension->save();

            return $this->sendResponse($mension, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $mension = Mension::findOrFail($id);
        return $this->sendData($mension);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mension = Mension::findOrFail($id);
        return $this->sendData($mension);
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
            $mension = Mension::findOrFail($id);

            $mension->designation = $request->input('designation');
            $mension->save();

            return $this->sendResponse($mension, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Mension::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
