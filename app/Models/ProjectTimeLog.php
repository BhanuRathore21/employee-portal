<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeLog extends Model
{
    use HasFactory;
    protected $table = 'project_details';
    protected $fillable = ['project_id', 'employee_id', 'logtime','description','created_at','updated_at']; 
}
