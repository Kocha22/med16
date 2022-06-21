<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     protected $guarded=[];
     
      public function divisions() {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
