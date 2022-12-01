<?php
namespace App\Http\Repositories;

use App\Http\Enums\UserEnum;
use App\Http\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class UserRepository implements IUserRepository
{

    public function register(Request $request) : User
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        $input = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if(Auth::attempt($input)){
            $user = Auth::user();
            if($user->status == UserEnum::INACTIVE){
                return null;
            }

            Passport::tokensExpireIn(Carbon::now()->addDays(30));
            Passport::refreshTokensExpireIn(Carbon::now()->addDays(60));

            $objToken = $user->createToken('Laravel Password Grant Client');

            $expiration = $objToken->token->expires_at->diffInSeconds(Carbon::now());

            return [
                'user' => $user,
                'token' => $objToken->accessToken,
                'refreshToken' => $expiration
            ];
        }

        return null;
    }
}
