<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\User;

class UsersList extends Controller
{
  public function index()
  {
    $userDataCollection = UserData::all();
    return view('content.users.users-list', [
      'userDataCollection' => $userDataCollection
    ]);
  }

  public function create(){
    return view('content.users.users-create');
  }

  public function createsubmit(Request $request){
  $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6',
  ]);
  User::create($request->all());
  return redirect()->route('users.index')->with('success', 'User created successfully');
  }
}
