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
}
