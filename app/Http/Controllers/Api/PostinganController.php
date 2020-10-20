<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Postingan;
use Illuminate\Http\Request;

class PostinganController extends Controller
{
    public function like(Postingan $postingan, Request $request)
    {
        $like = $postingan->like($postingan, $request->user_id);
        if($like === null){
            return response()->json(["message" => "anda sudah menyukai postingan ini"], 500);
        }

        return response()->json($like);
    }
    public function unlike(Postingan $postingan)
    {
        $like = $postingan->menyukai();
        if($like === null){
            return response()->json(["message" => "tidak menyukai postingan ini"], 500);
        }

        if($like->delete()){
            return response()->json(["message" => "berhasil unlike"], 200);
        }
    }

    public function menyukai(Postingan $postingan)
    {
        $menyukai = $postingan->menyukai();

        if($menyukai === null) {
            return response()->json(["id" => $postingan->id, "menyukai" => false], 202);
        }

        return response()->json(["id" => $postingan->id, "menyukai" => true], 200); 
    }
}
