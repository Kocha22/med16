<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    protected $guarded=[];

    public function scaneducations() {
        return $this->belongsToMany(Education::class);
      }
}
