<?php

namespace Modules\Auth\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::orderBy('id','desc')->paginate(5);
        return $permission;
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
        Permission::create($data);
        return $this->sendResponse('Création de Permission réussi');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return $permission;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->validate(['name' =>['required']]);
        $permission->update($data);
        return $this->sendResponse($permission,'Modification de Permission réussi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permission->delete();
        return $this->sendResponse($permission,'Suppression de Permission réussi');
    }

    public function assignRole(Request $request,Permission $permission)
    {
       if($permission->hasRole($request->role)){
        return $this->sendErrorResponse('Role exists.');
       }
       $permission->assignRole($request->role);
       return $this->sendResponse($permission,'Role assigned.');
    }

    public function removeRole(Permission $permission, Role $role)
    {
       if($permission->hasRole($role)){
        $permission->removeRole($role);
        return $this->sendResponse($permission,'Role removed');
       }
       return $this->sendErrorResponse('Role not exists');
    }
}
