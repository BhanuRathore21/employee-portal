<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
class ProjectController extends Controller
{
    public function list()
    {
        $users = User::all();
        return view('content.project_list.create',['users' => $users]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'employee' => 'required|array',
            'employee.*' => 'exists:users,id', 
            'client' => 'required',
            'created_at'=>'nullable|string|max:255',
            'updated_at'=>'nullable|string|max:255',
            'active'=>'nullable|string|max:1'
        ]);
    
        $employeeIds = implode(',', $request->input('employee'));

        Project::create(array_merge($request->except('employee'), ['employee' => $employeeIds]));
    
        return redirect()->route('projectlist')->with('success', 'Project added successfully!');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'employee' => 'required|array',
            'employee.*' => 'exists:users,id', 
            'client' => 'required',
            'created_at'=>'nullable|string|max:255',
            'updated_at'=>'nullable|string|max:255',
            'active'=>'nullable|string|max:1'
        ]);
    
        $employeeIds = implode(',', $request->input('employee'));

        Project::update(array_merge($request->except('employee'), ['employee' => $employeeIds]));
    
        return redirect()->route('projectlist')->with('success', 'Project Updated successfully!');
    }

    public function manage($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();
        return view('content.project_list.update',['users' => $users,'project'=>$project]);
    }
}
