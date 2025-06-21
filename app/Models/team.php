<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    use HasFactory;

    public function teamUsers()
    {
        return $this->belongsToMany(User::class,'team_user')->withPivot('status');
    }


}
