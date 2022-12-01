<?php
namespace App\Http\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function register(Request $request) : User;

    public function login(Request $request);
}
