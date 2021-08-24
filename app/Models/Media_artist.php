<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media_artist extends Model
{
    use HasFactory;
    protected $fillable=['slug', 'name', 'userpic'];

    public $timestamps = false;

    public function media_tracks(){
        return $this->hasMany('App\Models\Media_track');
    }
}
