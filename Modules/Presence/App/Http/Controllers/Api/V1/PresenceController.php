<?php

namespace Modules\Presence\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\JsonResponseTrait;
use Modules\Presence\App\Models\Presence;

class PresenceController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presence = Presence::with('eleve','author')->paginate(5);
        return $this->sendData($presence);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presence::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required',
            'heure_arriver' => 'required',
            'heure_sortie' => 'required',
        ]);

        try {
            $presence = new Presence();

            $presence->eleve_id = $request->input('eleve_id');
            $presence->heure_arriver = $request->input('heure_arriver');
            $presence->heure_sortie = $request->input('heure_sortie');
            $presence->author = Auth::user()->id;

            $presence->save();

            return $this->sendResponse($presence, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $presence = Presence::findOrFail($id);
        return $this->sendData($presence);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $presence = Presence::findOrFail($id);
        return $this->sendData($presence);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'eleve_id' => 'sometimes|integer',
            'heure_arriver' => 'sometimes|string',
            'heure_sortie' => 'sometimes|string',
        ]);

        try {
            $presence = Presence::findOrFail($id);

            $presence->eleve_id = $request->input('eleve_id');
            $presence->heure_arriver = $request->input('heure_arriver');
            $presence->heure_sortie = $request->input('heure_sortie');
            $presence->author = Auth::user()->id;

            $presence->save();

            return $this->sendResponse($presence, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Presence::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
