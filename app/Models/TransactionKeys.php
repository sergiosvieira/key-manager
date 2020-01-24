<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionKeys extends Model
{
    protected $fillable = ['transaction_id', 'key_id'];
}
