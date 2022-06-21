<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $guarded=[];

    public function typeofdocuments() {
        return $this->belongsToMany(Typeofdocument::class, 'typeofdocument_id', 'id');
    }
}
