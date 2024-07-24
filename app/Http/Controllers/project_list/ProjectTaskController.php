<?php
namespace App\Http\Controllers\project_list;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\TaskTimeLog;

class ProjectTaskController extends Controller
{
    public function index($id)
    {
        $tasks = ProjectTask::all();
        $project = Project::findOrFail($id);
        $tasks = ProjectTask::where('project_id', $id)->get();
        return view('content.project_list.tasklist', compact('tasks', 'project'));
    }
    public function createform($id)
    {
        $project = Project::findOrFail($id);
        return view('content.project_list.taskscreate', compact('project'));
    }

    public function edittaskform($id)
    {
        $projecttask = ProjectTask::findOrFail($id);
        $project = Project::findOrFail($projecttask->project_id);
        return view('content.project_list.tasksedit', compact('projecttask', 'project'));
    }

    public function updatetask(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'hours' => 'required|integer|min:0|max:23', 
            'minutes' => 'required|integer|min:0|max:59', 
            'status' => 'required|in:1,2,3',
        ]);
        $projecttask = ProjectTask::findOrFail($id);
        $existingTotalTime = $projecttask->total_time;
        list($existingHours, $existingMinutes, $existingSeconds) = explode(':', $existingTotalTime);
        $newHours = $existingHours + $validatedData['hours'];
        $newMinutes = $existingMinutes + $validatedData['minutes'];
        if ($newMinutes >= 60) {
            $newHours += floor($newMinutes / 60);
            $newMinutes = $newMinutes % 60;
        }
        $newTotalTime = sprintf('%02d:%02d:%02d', $newHours, $newMinutes, $existingSeconds);
        $projecttask->total_time = $newTotalTime;
        $projecttask->name = $validatedData['name'];
        $projecttask->status = $validatedData['status'];
        $projecttask->save();
        return redirect()->route('project_list.tasklist', $projecttask->project_id)->with('success', 'Task details updated successfully.');
    }
    public function createtask(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $task = new ProjectTask();
        $task->project_id = $id;
        $task->user_id = auth()->user()->id; 
        $task->name = $request->input('name');
        $task->save();
        return redirect()->route('project_list.tasklist', $id)->with('success', 'Task added successfully.');
    }

    public function addTimeLogForm($project_id, $task_id)
    {
        $task = ProjectTask::findOrFail($task_id);
        return view('tasks.addtimelog', compact('task'));
    }

    public function storeTimeLog(Request $request, $project_id, $task_id)
    {
        $request->validate([
            'hours' => 'required|integer|min:0',
            'minutes' => 'required|integer|min:0|max:59',
        ]);

        $timeLog = new TaskTimeLog();
        $timeLog->task_id = $task_id;
        $timeLog->hours = $request->input('hours');
        $timeLog->minutes = $request->input('minutes');
        $timeLog->save();

        return redirect()->route('tasks.addtimelog', [$project_id, $task_id])->with('success', 'Time log added successfully.');
    }
}
