<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    protected $fillable = ['project_id', 'user_id', 'name','total_time'];

    public function project()
    {
        return $this->belongsTo(Project::class); 
    }

}