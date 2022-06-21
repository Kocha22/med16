<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $guarded=[];
    
    public function appextra() {
        return $this->belongsToMany(Applicant::class);
    }
    
    public function typeofdocuments() {
        return $this->belongsTo(Typeofdocument::class, 'typeofdocument_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function userappform() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
