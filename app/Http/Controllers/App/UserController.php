<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Teman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('app.addteman_', ['users' => User::query()->where('aktif', '=', 1)->get()]);
    }

    public function showprofile(Request $request)
    {
        $url = explode("/", $request->path());
        $user = end($url);
        $userData = User::query()->with('postingans')->where('name', '=', $user)->first();

        if ($userData === null) {
            return redirect()->back();
        }
        
        return view('app.profile_', ['user' => $userData, 'gw' => Auth::user()]);
    }

    public function kirimpesan(Request $request)
    {
        $url = explode("/", $request->path());
        $teman = User::query()->where("name", "=", end($url))->first();
        
        return view('app.kirim_pesan_', ["teman" => $teman]);
    }
}
