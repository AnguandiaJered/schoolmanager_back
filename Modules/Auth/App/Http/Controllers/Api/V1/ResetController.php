<?php

namespace Modules\Auth\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Traits\JsonResponseTrait;
use Modules\Auth\App\Emails\ResetPassword;

class ResetController extends Controller
{
    use JsonResponseTrait;

    public function requestReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user) {
            return $this->sendMessage('Email doesnt exists', 422);
        }

        $token = Str::random(60);

        PasswordReset::firstOrCreate([
            'email' => $request->email,
        ], [
            'token' => $token,
            'created_at' => Carbon::now()
        ]);


        Mail::to($user)->send(new ResetPassword($token, $user->otp_number));

        // Mail::to($user)->queue(new ResetPassword($token, $user->otp_number));

        // Mail::to($user)->later(now()->addSeconds(5), new ResetPassword($token, $user->otp_number));

        return $this->sendResponse($user, 'Passord Reset Email Sent ... Check Your Email');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'user' => 'required|integer',
            'code' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::whereId($request->input('user'))->first();

        if (!$user) {
            return $this->sendErrorResponse('Aucun utilisateur trouvé pour cette requette.');
        }

        if ($request->input('code') == $user->otp_number) {
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return $this->sendResponse($user, 'Mot de passe réinitialiser avec succèss.');
        } else {
            return $this->sendErrorResponse('Code de réinitialisation est invalide');
        }
    }
}
