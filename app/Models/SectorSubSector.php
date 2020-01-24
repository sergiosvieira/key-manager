<?php

namespace App\Models;

use App\Models\Key;
use Illuminate\Database\Eloquent\Model;

class SectorSubSector extends Model
{
    protected $fillable = ['sector_id', 'subsector_id'];
    protected $table = 'sectors_sub_sectors';
    public function keys()
    {
        return $this->hasMany(Key::class, 'keys');
    }
}
