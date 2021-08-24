<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media_track extends Model
{
    use HasFactory;
    protected $fillable=['name', 'media_artist_id'];

    public function media_artist(){
        return $this->belongsTo('App\Models\Media_artist');
    }

}
