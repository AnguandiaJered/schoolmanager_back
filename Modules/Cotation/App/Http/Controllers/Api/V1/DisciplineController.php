<?php

namespace Modules\Cotation\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;
use Modules\Cotation\App\Models\Discipline;

class DisciplineController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discipline = Discipline::with('eleve','period','mention','user')->paginate(5);
        return $this->sendData($discipline);
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
            'eleve_id' => 'required',
            'period_id' => 'required',
            'mention_id' => 'required',
        ]);

        try {
            $discipline = new Discipline();

            $discipline->designation = $request->input('designation');
            $discipline->eleve_id = $request->input('eleve_id');
            $discipline->period_id = $request->input('period_id');
            $discipline->mention_id = $request->input('mention_id');
            $discipline->author = Auth::user()->id;
            $discipline->save();

             return $this->sendResponse($discipline, 'Enregistrement réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec d\'enregistrement',$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $discipline = Discipline::findOrFail($id);
        return $this->sendData($discipline);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discipline = Discipline::findOrFail($id);
        return $this->sendData($discipline);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'designation' => 'sometimes|string',
            'eleve_id' => 'sometimes|integer',
            'period_id' => 'sometimes|integer',
            'mention_id' => 'sometimes|integer',
        ]);

        try {
            $discipline = Discipline::findOrFail($id);

            $discipline->designation = $request->input('designation');
            $discipline->eleve_id = $request->input('eleve_id');
            $discipline->period_id = $request->input('period_id');
            $discipline->mention_id = $request->input('mention_id');
            $discipline->author = Auth::user()->id;
            $discipline->save();

             return $this->sendResponse($discipline, 'Modification réussi');
        } catch (\Exception $ex) {
            return $this->sendErrorResponse('Echec de modification',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Discipline::find($id)->delete();
        return $this->sendResponse('Suppression réussi');
    }
}
