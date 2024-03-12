<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_reset_tokens extends Model
{
    use HasFactory;
    public $tablename="password_reset_tokens";
    public $timestamps = false;
}
