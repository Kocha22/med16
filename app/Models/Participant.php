<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    protected $guarded=[];

    public function applicationspar() {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }

    public function applicantspar() {
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }

    public function contestspar() {
        return $this->belongsTo(Contest::class, 'contest_id', 'id');
    }
}
