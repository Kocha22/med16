<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded=[];

    public function appexperience() {
      return $this->belongsToMany(Applicant::class);
    }

    public function organizations()
    {
      return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function positions()
    {
      return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function users() {
      return $this->belongsToMany(User::class);
  }

      public function userappform() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
