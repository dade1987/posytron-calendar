<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = ['user_id', 'start_time', 'end_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
