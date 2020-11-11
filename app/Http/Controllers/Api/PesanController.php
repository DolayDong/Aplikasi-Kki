<?php

namespace App\Http\Controllers\Api;

use App\Events\PesanBaru;
use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{

    public function index($id)
    {
        // dd($user->id);
        return response()->json(Pesan::where('user_id', '=',$id)->orWhere('teman_id', '=', $id)->latest('dikirim')->get());
    }
    public function insert(Request $request, User $user)
    {
        $pesan = Pesan::newPesan($request, $user);
        if($pesan !== null){
            event(new PesanBaru($pesan));
            return response()->json($pesan);
        } else {
            return response()->json(["message" => "gagal"], 500);
        }

    }
}
