<?php

namespace App\Http\Controllers\project_list;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
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
}
