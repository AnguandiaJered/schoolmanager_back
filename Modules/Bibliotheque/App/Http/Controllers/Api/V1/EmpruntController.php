<?php

namespace Modules\Bibliotheque\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Bibliotheque\App\Models\EmpruntLivre;
use Illuminate\Support\Facades\Auth;

class EmpruntController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprunt = EmpruntLivre::with('eleve','livre','user')->paginate(5);
        return $this->sendData($emprunt);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bibliotheque::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleve_id'=>'required',
            'livre_id'=>'required',
            'dateretrait'=>'required',
            'dateretour'=>'required',
            'nombre'=>'required',
        ]);

        try {
            $emprunt = new EmpruntLivre();

            $emprunt->eleve_id=$request->input('eleve_id');
            $emprunt->livre_id=$request->input('livre_id');
            $emprunt->dateretrait=$request->input('dateretrait');
            $emprunt->dateretour=$request->input('dateretour');
            $emprunt->nombre=$request->input('nombre');
            $emprunt->author = Auth::user()->id;
            $emprunt->save();

            return $this->sendResponse($emprunt, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $emprunt = EmpruntLivre::findOrFail($id);
        return $this->sendData($emprunt);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emprunt = EmpruntLivre::findOrFail($id);
        return $this->sendData($emprunt);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'eleve_id'=>'sometimes|integer',
            'livre_id'=>'sometimes|integer',
            'dateretrait'=>'sometimes|string',
            'dateretour'=>'sometimes|string',
            'nombre'=>'sometimes|integer',
        ]);

        try {
            $emprunt = EmpruntLivre::findOrFail($id);

            $emprunt->eleve_id=$request->input('eleve_id');
            $emprunt->livre_id=$request->input('livre_id');
            $emprunt->dateretrait=$request->input('dateretrait');
            $emprunt->dateretour=$request->input('dateretour');
            $emprunt->nombre=$request->input('nombre');
            $emprunt->author = Auth::user()->id;
            $emprunt->save();

            return $this->sendResponse($emprunt, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        EmpruntLivre::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
