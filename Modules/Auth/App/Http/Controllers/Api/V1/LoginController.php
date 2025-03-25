<?php

namespace Modules\Auth\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Traits\JsonResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Modules\Auth\App\resources\Transformers\UserResource;
use Modules\Auth\App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    use JsonResponseTrait, AuthenticatesUsers;
    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request)
    {
        //code d'auth avec sanctum
        $user = User::findForSanctum($request->input('phone'));
        //User::where('email', $request->email)->first();

        //check the password
        if (
            !$user || !Hash::check($request->password, $user->password)
        ) {
            return $this->sendErrorResponse('Verifier votre authentification svp !!!');
        }

        if ($user->active) {
            if ($user->verified) {
                $token = $user->createToken($request->input('device_name'))->plainTextToken;

                $reponse = [
                    'user' => new UserResource($user),
                    'token' => $token
                ];

                return $this->sendResponse($reponse, ' Vous etes bien connecté sur notre app');
            } else {
                return $this->sendErrorResponse('Votre compte n\'est pas vérifier');
            }
        } else {
            return $this->sendErrorResponse('Votre compte est désativer');
        }
    }

    //    public function logout(){
    //         auth()->user()->currentAccessToken()->delete();
    //         return response()->json([
    //             'status' => 'true',
    //             'message' => 'Vous etes déconnecté'
    //         ]);
    //    }

    public function logout(Request $request)
    {

        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 'true',
                'message' => 'Vous etes déconnecté'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage()
            ]);
        }
    }
}
