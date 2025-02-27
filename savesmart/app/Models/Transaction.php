<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'type', 'amount', 'category_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
