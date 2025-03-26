<?php

namespace Modules\Auth\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    use JsonResponseTrait;

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'sometimes|email|unique:users',
            'phone' => ['required', 'phone:AUTO,mobile'],
            'password' => 'required|min:6|confirmed',
        ]);

        //code.....
        $otpNumber=$this->generateOpt(6);

        // $user = User::where('phone', User::getParsedPhone('phone'))->orWhere('email', $request->input('email'))->first();
        $user = User::findForSanctum($request->input('email'));

        if (!$user) {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = User::getParsedPhone('phone');
            $user->country_code = User::getParsedCountryCode('phone');
            $user->password = bcrypt($request->input('password'));
            $user->otp_number = $otpNumber;
            $user->active = true;
            $user->verified = false;
            $user->save();

            //lancer l'evenent en fin d'ecouter et envoyer l'email
            event(new Registered($user));

            return $this->sendResponse($user, 'Création compte réussi');
        }
        return $this->sendErrorResponse('Ce numéro ou email existe déjà dans notre base de données');
    }

    public function resendCode($user)
    {
        $user = User::whereId($user)->first();

        event(new Registered($user));

        return $this->sendResponse($user, "Le code vient d'etre envoyer par mail");
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'user' => 'required|integer'
        ]);

        $user = User::whereId($request->input('user'))->first();
        if (!$user) {
            return $this->sendErrorResponse("Cet utilisateur n'existe pas dans notre base de données");
        }

        $code = $request->input('code');

        if ($code === $user->otp_number) {
            //valider user
            $user->verified = true;
            $user->save();

            return $this->sendResponse($user, 'Vérificiation terminer avec sucèss.');
        }

        return $this->sendErrorResponse("Le code envoyer est invalide");
    }

    public function assignRole(Request $request,User $user)
    {
       if($user->hasRole($request->role)){
        return $this->sendErrorResponse('Role exists.');
       }
       $user->assignRole($request->role);
       return $this->sendResponse($user,'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
       if($user->hasRole($role)){
        $user->removeRole($role);
        return $this->sendResponse($user,'Role removed');
       }
       return $this->sendErrorResponse('Role not exists');
    }

    public function givePermission(Request $request,User $user)
    {
       if($user->hasPermissionTo($request->permission)){
        return $this->sendErrorResponse('Permission exists');
       }
       $user->givePermissionTo($request->permission);
       return $this->sendResponse($user,'Permission added');
    }

    public function revokePermission(User $user, Permission $permission)
    {
       if($user->hasPermissionTo($permission)){
        $user->revokePermissionTo($permission);
        return $this->sendResponse($user,'Permission revoked');
       }
       return $this->sendErrorResponse('Permission does not exists');
    }
}
