<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listnotification extends Model
{
    protected $table = 'listnotifications';
    protected $guarded=[];

    public function departments() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function positions() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function typenotifications() {
        return $this->belongsTo(Typenotification::class, 'typenotification_id', 'id');
    }
}
