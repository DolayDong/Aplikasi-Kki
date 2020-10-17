<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('app.addteman_', ['user' => Auth::user(), 'users' => User::query()->where('aktif', '=', 1)->get()]);
    }

    public function showprofile(Request $request)
    {
        $url = explode("/", $request->path());
        $user = end($url);
        $userData = User::query()->with('postingans')->where('name', '=', $user)->first();

        return view('app.profile_', ['user' => $userData]);
    }
}
