<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $guarded=[];

    public function organizations()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function positions()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
