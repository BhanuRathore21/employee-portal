<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskTimeLog extends Model
{
    protected $fillable = ['project_task_id', 'user_id', 'time_logged', 'description'];

    public function projectTask()
    {
        return $this->belongsTo(ProjectTask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
