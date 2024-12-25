<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $filable = [
        'user:id',
        'follower_id'
    ];
}
