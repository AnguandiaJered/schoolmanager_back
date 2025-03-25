<?php

namespace Modules\Auth\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

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

        // $user = User::where('phone', User::getParsedPhone('phone'))->orWhere('email', $request->input('email'))->first();
        $user = User::findForSanctum($request->input('email'));

        if (!$user) {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = User::getParsedPhone('phone');
            $user->country_code = User::getParsedCountryCode('phone');
            $user->password = bcrypt($request->input('password'));
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

        if ($code === '123456') {
            //valider user
            $user->verified = true;
            $user->save();

            return $this->sendResponse($user, 'Vérificiation terminer avec sucèss.');
        }

        return $this->sendErrorResponse("Le code envoyer est invalide");
    }
}
