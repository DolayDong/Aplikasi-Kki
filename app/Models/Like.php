<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["user_id", "teman_id", "postingan_id", "like_pada"];

    public function postingan()
    {
        return $this->belongsTo('App\Models\Postingan', 'id', 'postinan_id');
    }

    public function mrLike()
    {
        return $this->belongsTo('App\Models\User', 'id', 'teman_id');
    }

    public function mrPost()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
}
