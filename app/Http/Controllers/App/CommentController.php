<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Postingan $postingan)
    {
        // yang baru dipost di taruh diatas
        return response()->json($postingan->comments()->with('user')->latest('dibuat')->get());
        
    }

    public function store(Request $request, Postingan $postingan)
    {

        // data comment dari client
        $comment = $postingan->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'dibuat' => time()
        ]);

        // jika berhasil disimpan
        if($comment->save()){
            // kemablisan response json data yang berhasil disimpan
            $comment = Comment::query()->where('id', '=', $comment->id)->with('user')->first();
            return $comment->toJson();
        }
        
    }
}
