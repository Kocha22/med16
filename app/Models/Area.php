<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $guarded=[];

    public function children()
    {
        return $this->hasMany(Area::class, 'parent','id');
    }

    public function parent_ho()
    {
        return $this->belongsTo(Area::class, 'parent');
    }

    public function scopeRoot($query)
    {
        $query->where('parent', 4948);
    }
}
