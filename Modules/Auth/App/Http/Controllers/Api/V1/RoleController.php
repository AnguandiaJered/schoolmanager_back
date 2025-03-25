<?php

namespace Modules\Auth\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::orderBy('id','desc')->paginate(5);
        return $role;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['name' =>['required']]);
        Role::create($data);
        return $this->sendResponse('Création de role réussi');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return $role;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return $role;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate(['name' =>['required']]);
        $role = Role::findOrFail($id);
        $role->update([
            'name'=>$request->name,
        ]);
        return $this->sendResponse($role,'Modification de role réussi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role->delete();
        return $this->sendResponse($role,'Suppression de role réussi');
    }

    public function givePermission(Request $request,Role $role)
    {
       if($role->hasPermissionTo($request->permission)){
        return $this->sendErrorResponse('Permission exists');
       }
       $role->givePermissionTo($request->permission);
       return $this->sendResponse($role,'Permission added');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
       if($role->hasPermissionTo($permission)){
        $role->revokePermissionTo($permission);
        return $this->sendResponse($role,'Permission revoked');
       }
       return $this->sendErrorResponse('Permission not exists');
    }
}
