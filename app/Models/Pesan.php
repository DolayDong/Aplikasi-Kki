<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Pesan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["body","user_id", "teman_id", "filetype", "url_file", "dikirim"];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }

    public static function newPesan(Request $request, User $user)
    {
        // dd($request);
        $isfile = ($request->file('pesangambar')) ? true : false;
        $path = null;
        $url_file = null;
        if($isfile){
            $path = $request->file('pesangambar')->store('/public/imagepesan/' . Auth::user()->name . '/');
            $url_file = str_replace("public", "/storage", $path);
        }

        $pesan = Pesan::query()->create([
            'user_id' => Auth::id(),
            'teman_id' => $user->id,
            'filetype' => $isfile,
            'url_file' => $url_file,
            'body' => $request->deskripsi,
            'dikirim' => time()
        ]);

        if($pesan->save()){
            return $pesan;
        } else {
            return null;
        }
        
    }
}
