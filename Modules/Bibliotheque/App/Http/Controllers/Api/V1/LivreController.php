<?php

namespace Modules\Bibliotheque\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Modules\Bibliotheque\App\Models\Livre;

class LivreController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livre = Livre::latest()->get();
        return $this->sendData($livre);
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
            'title' => 'required',
            'auteur' => 'required',
            'etatlivre' => 'required',
            'exemplaire' => 'required',
        ]);

        try {
            $livre = new Livre();

            $livre->title = $request->input('title');
            $livre->auteur = $request->input('auteur');
            $livre->etatlivre = $request->input('etatlivre');
            $livre->exemplaire = $request->input('exemplaire');

            $livre->save();

            return $this->sendResponse($livre, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $livre = Livre::findOrFail($id);
        return $this->sendData($livre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $livre = Livre::findOrFail($id);
        return $this->sendData($livre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string',
            'auteur' => 'sometimes|string',
            'etatlivre' => 'sometimes|string',
            'exemplaire' => 'sometimes|integer',
        ]);

        try {
            $livre = Livre::findOrFail($id);

            $livre->title = $request->input('title');
            $livre->auteur = $request->input('auteur');
            $livre->etatlivre = $request->input('etatlivre');
            $livre->exemplaire = $request->input('exemplaire');

            $livre->save();

            return $this->sendResponse($livre, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Livre::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
