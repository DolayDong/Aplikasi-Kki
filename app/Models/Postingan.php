<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Postingan extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "caption", "url_image", "diunggah"];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function teman()
    {
        return $this->belongsTo('App\Models\Teman', 'teman_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'postingan_id', 'id');
    }

    public function like(Postingan $postingan, $mrPost)
    {

        if($this->likes()->where('postingan_id', '=', $postingan->id)->where('teman_id', '=', Auth::id())->first()){
            return null;
        }

        return $this->likes()->save(
            new Like([
                'postingan_id' => $postingan->id,
                'teman_id' => Auth::id(),
                'like_pada' => time(),
                'user_id' => $mrPost
            ])
        );
    }

    public function menyukai()
    {
        return Like::where('teman_id', '=', Auth::id())->where('user_id', '=', $this->user_id)->where('postingan_id', '=', $this->id)->first();
    }


}
