<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name' // Add [project_name] to allow mass assignment for this property

        // Add other attributes as needed
    ];
    public $tablename="projects";
}
