<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    protected $guarded=[];

    public function appattestation() {
        return $this->belongsToMany(Applicant::class);
    }

    public function typeofdocuments() {
        return $this->belongsTo(Typeofdocument::class, 'typeofdocument_id', 'id');
    }

    public function qualifications() {
        return $this->belongsTo(Qualification::class, 'qualification_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function userappform() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
