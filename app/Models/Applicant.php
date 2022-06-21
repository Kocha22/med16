<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $guarded=[];

    public function usersaction() {
        return $this->belongsToMany('App\User'::class);
    }
    
     public function isAdmin($post_id) {
        return $this->usersaction()->where('applicant_id', $post_id)->exists();
     }

    public function educations() {
        return $this->belongsToMany(Education::class);
    }

    public function experiences() {
        return $this->belongsToMany(Experience::class);
    }

    public function attestations() {
        return $this->belongsToMany(Attestation::class);
    }

    public function extras() {
        return $this->belongsToMany(Extra::class);
    }
    
     public function appstatuses() {
        return $this->belongsTo(Appstatus::class, 'appstatus_id', 'id');
    }

    public function userspersonapp() {
        return $this->belongsToMany(User::class);
    }

    public function userappform() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function appuserstatus() {
        return $this->belongsTo(Appuserstatus::class, 'appuserstatus_id', 'id');
    }

    public function contests() {
        return $this->belongsToMany(Contest::class);
    }

    public function notemessage() {
        return $this->belongsToMany(Notemessage::class);
    }
}
