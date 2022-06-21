<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notemessage extends Model
{
    protected $guarded=[];

    public function appsnotemessage() {
        return $this->belongsToMany(Applicant::class);
    }
}
