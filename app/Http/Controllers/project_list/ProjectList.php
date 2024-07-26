<?php

namespace App\Http\Controllers\project_list;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectTimeLog;

class ProjectList extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $users = User::all()->keyBy('id');

        foreach ($projects as $project) {
            if (strpos($project->employee, ',') !== false) {
                $employeeIds = explode(',', $project->employee);
                $employeeNames = [];
                foreach ($employeeIds as $employeeId) {
                    if ($users->has($employeeId)) {
                        $employeeNames[] = $users[$employeeId]->username;

                    }
                }
                $project->employee = implode(', ', $employeeNames);
            } else {
                if ($users->has($project->employee)) {
                    $project->employee = $users[$project->employee]->username;
                } else {
                    $project->employee = 'Unknown';
                }
            }
        }

        return view('content.project_list.projectlist', ['projects' => $projects]);
    }
    public function list()
    {
        $users = User::where('type', 'user')->get();
        return view('content.project_list.create', ['users' => $users]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'employee' => 'required|array',
            'employee.*' => 'exists:users,id',
            'client' => 'required',
            'created_at' => 'nullable|string|max:255',
            'updated_at' => 'nullable|string|max:255',
            'active' => 'nullable|string|max:1'
        ]);

        $employeeIds = implode(',', $request->input('employee'));

        $project = Project::create(array_merge($request->except('employee'), ['employee' => $employeeIds]));
        foreach ($request->input('employee') as $employeeId) {
            $this->createProjectTimeLog($project->id, $employeeId);
        }

        return redirect()->route('projectlist')->with('success', 'Project added successfully!');
    }

    public function editprojectsubmit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'employee' => 'required|array',
            'employee.*' => 'exists:users,id',
            'client' => 'required',
            'created_at' => 'nullable|string|max:255',
            'updated_at' => 'nullable|string|max:255',
            'active' => 'nullable|string|max:1'
        ]);

        $project = Project::findOrFail($id);
        $employeeIds = $request->input('employee');
        if (count($employeeIds) > 1) {
            $employeeIds = implode(',', $employeeIds);
        } else if (count($employeeIds) == 1) {
            $employeeIds = reset($employeeIds);
        } else {
            $employeeIds = null;
        }
    
        $project->name = $request->input('name');
        $project->client = $request->input('client');
        $project->active = $request->input('status');
        $project->employee = $employeeIds; 
        $project->save();

        return redirect()->route('projectlist')->with('success', 'Project Updated successfully!');
    }
    protected function createProjectTimeLog($projectId, $employeeId)
    {
        $log = new ProjectTimeLog();
        $log->project_id = $projectId;
        $log->employee_id = $employeeId;
        $log->logtime = null;
        $log->description = null;
        $log->save();
    }
    public function projecteditform($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();
        return view('content.project_list.update', ['users' => $users, 'project' => $project]);
    }
    public function delete($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return redirect()->back()->with('error', 'project not found.');
        }

        try {
            $project->delete();
            return redirect()->route('projectlist')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting user. Please try again.');
        }
    }
}
