<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valid extends Model
{
    protected $guarded=[];

    public function qualifications()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id', 'id');
    }

}
