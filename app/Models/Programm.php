<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programm extends Model
{
    protected $table = 'programmes';
    protected $guarded=[];

    public function applications() {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }

    public function applicants() {
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }

    public function contests() {
        return $this->belongsTo(Contest::class, 'contest_id', 'id');
    }
}
