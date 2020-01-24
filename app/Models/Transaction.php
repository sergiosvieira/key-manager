<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['gatekeeper_id', 'user_id', 'status'];
    public function transaction_keys()
    {
        return $this->hasMany('App\Models\TransactionKeys');
    }
}
