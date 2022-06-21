<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $guarded=[];

    public function departments() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function positions() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function appcontests() {
        return $this->belongsToMany(Applicant::class);
    }
}
