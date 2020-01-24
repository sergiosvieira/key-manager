<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['name'];
    public function sub_sector()
    {
        return $this->belongsToMany(SubSector::class, 'sectors_sub_sectors');
    }
}
