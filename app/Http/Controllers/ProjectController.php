<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function create()
    {
        return view('content.project_list.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'employee' => 'required',
            'client' => 'required',
            'created_at'=>'nullable|string|max:255',
            'updated_at'=>'nullable|string|max:255',
            'active'=>'nullable|string|max:1'
        ]);

        Project::create($request->all());

        return redirect()->route('project_list.create')->with('success', 'Project added successfully!');
    }
}
