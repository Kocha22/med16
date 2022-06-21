<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $guarded=[];

    public function applicants() {
      return $this->belongsToMany(Applicant::class);
    }

    public function typeofeducation()
    {
      return $this->belongsTo(Typeofeducation::class, 'typeofeducation_id', 'id');
    }

    public function specialities()
    {
      return $this->belongsTo(Speciality::class, 'speciality_id', 'id')->withDefault();
    }

    public function professions()
    {
      return $this->belongsTo(Profession::class, 'speciality_id', 'id')->withDefault();
    }

    public function scans() {
      return $this->belongsToMany(Scan::class);
    }

    public function kindeducations() {
      return $this->belongsTo(KindEducation::class, 'kind_education_id', 'id');
    }

      public function users() {
        return $this->belongsToMany(User::class);
    }
      public function userappform() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
