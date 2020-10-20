<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "user_agent", "aktifitas_terakhir"];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
