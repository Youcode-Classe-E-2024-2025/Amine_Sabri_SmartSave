<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['profile_id', 'type', 'amount', 'category', 'description', 'date'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
