<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Interfaces\IUserRepository;
use App\Jobs\SendEmailVerifyAccountJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private IUserRepository $iUser;
    public function __construct(IUserRepository $iUser)
    {
        $this->iUser = $iUser;
    }

    public function login(Request $request) : Response
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        $this->validateRequest($request, $validator);

        $result = $this->iUser->login($request);

        if($result === null) return $this->unauthorized();

        return $this->ok($result);
    }

    public function register(Request $request) : Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:50',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'string|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        $this->validateRequest($request, $validator);

        $user = $this->iUser->register($request);
        if($user){
            dispatch(new SendEmailVerifyAccountJob($user))->delay(now()->addMinutes(5));
            return $this->ok($user);
        }

        return $this->badRequest();
    }
}
