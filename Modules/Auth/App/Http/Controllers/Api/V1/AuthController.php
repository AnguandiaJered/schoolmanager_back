<?php

namespace Modules\Auth\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\JsonResponseTrait;
use Auth;
use Modules\Auth\App\resources\Transformers\UserResource;

class AuthController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function me(Request $request)
    {
        $user = $request->user();
        //$user = auth()->user();

        return $this->sendData([
            'user' => new UserResource($user)
        ]);
    }

    public function notifications(Request $request)
    {
        $user = $request->user();
        //$user = auth()->user();

        if($request->has('unreadNotifications') && (int)$request->input('unreadNotifications') == 1){
            $notifications = $user->unreadNotifications()->paginate(config('schoolmanager.paginate'));
        }else{
            $notifications = $user->notifications()->paginate(config('schoolmanager.paginate'));
        }
        return $this->sendData($notifications);
    }
}
