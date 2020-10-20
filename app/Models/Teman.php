<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teman extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "teman_id", "berteman_pada"];
    public $timestamps = false;
    protected $table = "temans";
    protected $guarded = ["id"];

    // api list teman
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    
    public function session()
    {
        return $this->hasOne('App\Models\Session', 'user_id', 'teman_id');
    }
    
    public function teman()
    {
        return $this->hasOne(User::class, 'id', 'teman_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'teman_id');
    }
    
    public function postingans()
    {
        return $this->hasMany('App\Models\Postingan', 'user_id', 'teman_id');
    }

 
}
