<?php

namespace Modules\Bibliotheque\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Bibliotheque\App\Models\RemiseLivre;
use Illuminate\Support\Facades\Auth;

class RemiseController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $remise = RemiseLivre::with('empruntlivre','livre','user')->paginate(5);
        return $this->sendData($remise);
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
            'emprunt_id'=>'required',
            'livre_id'=>'required',
            'nbr_retour'=>'required',
            'dateretour'=>'required',
        ]);

        try {
            $remise = new RemiseLivre();

            $remise->emprunt_id=$request->input('emprunt_id');
            $remise->livre_id=$request->input('livre_id');
            $remise->nbr_retour=$request->input('nbr_retour');
            $remise->dateretour=$request->input('dateretour');
            $remise->author = Auth::user()->id;
            $remise->save();

            return $this->sendResponse($remise, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $remise = RemiseLivre::findOrFail($id);
        return $this->sendData($remise);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $remise = RemiseLivre::findOrFail($id);
        return $this->sendData($remise);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'emprunt_id'=>'sometimes|integer',
            'livre_id'=>'sometimes|integer',
            'nbr_retour'=>'sometimes|integer',
            'dateretour'=>'sometimes|string',
        ]);

        try {
            $remise = RemiseLivre::findOrFail($id);

            $remise->emprunt_id=$request->input('emprunt_id');
            $remise->livre_id=$request->input('livre_id');
            $remise->nbr_retour=$request->input('nbr_retour');
            $remise->dateretour=$request->input('dateretour');
            $remise->author = Auth::user()->id;
            $remise->save();

            return $this->sendResponse($remise, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        RemiseLivre::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
