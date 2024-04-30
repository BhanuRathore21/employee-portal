<?php

namespace App\Http\Controllers\project_list;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectList extends Controller
{
  public function index()
  {
    return view('content.project_list.projectlist');
  }
}
