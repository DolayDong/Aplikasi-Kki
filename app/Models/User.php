<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Teman;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'aktif'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // postingan api
    public function postingans()
    {
        return $this->hasMany('App\Models\Postingan', 'user_id');
    }

    // comments api
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    // teman api
    public function temans()
    {
        return $this->hasMany(Teman::class);
    }

  

    // online atau tidak api
    public function session()
    {
        return $this->hasOne('App\Models\Session', 'user_id');
    }

    public function tambahTeman(User $user)
    {
        // dd($this->temans()->where('teman_id', '=', $user->id)->first());
        if($this->temans()->where('teman_id', '=', $user->id)->first()){
            return null;
        }

        return $this->temans()->save(new Teman([
            'teman_id' => $user->id,
            'berteman_pada' => time() 
        ]));
    }

    public function mengikuti()
    {
        return Teman::where('user_id', '=', auth()->id())->where('teman_id','=', $this->id)->first();
    }

    public function mrLike()
    {
        return $this->hasOne('App\Models\Like', 'user_id', 'id');
    }

    public function mrPost()
    {
        return $this->hasOne('App\Models\Like', 'teman_id', 'id');
    }


}
