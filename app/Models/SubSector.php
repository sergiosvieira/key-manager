<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSector extends Model
{
    protected $fillable = ['name'];
    public function sector()
    {
        return $this->belongsToMany(SubSector::class, 'sectors_sub_sectors');
    }
}
