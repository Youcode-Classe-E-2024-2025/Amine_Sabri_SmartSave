<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsGoal extends Model
{
    use HasFactory;
    protected $fillable = ['profile_id', 'name', 'target_amount', 'saved_amount', 'deadline'];
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
