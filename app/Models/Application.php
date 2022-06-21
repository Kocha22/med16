<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded=[];

    public function appstatuses() {
        return $this->belongsTo(Appstatus::class, 'appstatus_id', 'id');
    }
    
     public function appuserstatus() {
        return $this->belongsTo(Appuserstatus::class, 'appuserstatus_id', 'id');
    }
    
    public function usersaction() {
        return $this->belongsToMany('App\User'::class);
    }
}
