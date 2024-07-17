<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UsersList extends Controller
{
  public function index()
  {
    $userDataCollection = UserData::all();
    return view('content.users.users-list', [
      'userDataCollection' => $userDataCollection
    ]);
  }

  public function create()
  {
    $countries = [
      'Australia' => 'Australia',
      'Bangladesh' => 'Bangladesh',
      'India' => 'India',
      'Canada' => 'Canada',
      'Belarus' => 'Belarus',
      'Germany' => 'Germany',
      'Israel' => 'Israel',
      'Japan' => 'Japan',
      'Korea' => 'Korea',
      'Philippines' => 'Philippines',
      'Ukraine' => 'Ukraine',
      'United States' => 'United States',

    ];

    $languages = [
      'en' => 'English',
      'fr' => 'French',
      'de' => 'German',
      'pt' => 'Portuguese',
    ];

    $timeZones = [
      'GMT-12' => '(GMT-12:00) International Date Line West',
      'GMT-11' => '(GMT-11:00) Midway Island, Samoa',
      'GMT-10' => '(GMT-10:00) Hawaii',
      'GMT-9' => '(GMT-9:00) Alaska',
      'GMT-8' => '(GMT-8:00) Tijuana',
      'GMT-7' => '(GMT-7:00) Arizona',
      'GMT-6' => '(GMT-6:00) Central America',
      'GMT-5' => '(GMT-5:00) Bogota',
      'GMT-4' => '(GMT-4:00) Atlantic Time (Canada)',
    ];

    $currencies = [
      'usd' => 'USD',
      'euro' => 'Euro',
      'pound' => 'Pound',
      'bitcoin' => 'Bitcoin',
    ];
    return view('content.users.users-create', [
      'countries' => $countries,
      'languages' => $languages,
      'timeZones' => $timeZones,
      'currencies' => $currencies,
    ]);
  }

  public function CreateSubmit(Request $request)
  {
    $request->validate([
      'username' => 'required|string',
      'first_name' => 'required|string',
      'last_name' => 'nullable|string',
      'email' => 'required|email|unique:users,email',
      'organization' => 'nullable|string',
      'phone_number' => 'nullable|string',
      'address' => 'nullable|string',
      'state' => 'nullable|string',
      'zip_code' => 'nullable|string',
      'country' => 'nullable|string',
      'language' => 'nullable|string',
      'password' => 'required|string|min:6',
      'time_zones' => 'nullable|string',
      'currency' => 'nullable|string',
    ]);

    $userData = [
      'username' => $request->username,
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'organization' => $request->organization,
      'phone_number' => $request->phone_number,
      'address' => $request->address,
      'state' => $request->state,
      'zip_code' => $request->zip_code,
      'country' => $request->country,
      'language' => $request->language,
      'password' => Hash::make($request->password),
      'time_zones' => $request->time_zones,
      'currency' => $request->currency,
      'active' => 1,
    ];
    if ($request->hasFile('avatar')) {
      $avatar = $request->file('avatar');
      $avatarPath = $avatar->store('avatars', 'public');
      $userData['profile_image'] = $avatarPath;
    }

    try {
      $user = User::create($userData);
      if ($user) {
        return redirect()->route('users-list')->with('success', 'User created successfully');
      } else {
        return redirect()->back()->with('error', 'Failed to create user.');
      }
    } catch (\Exception $e) {
      \Log::error('Error creating user: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error creating user. Please try again.');
    }
  }
  public function manage($id)
  {
    $countries = [
      'Australia' => 'Australia',
      'Bangladesh' => 'Bangladesh',
      'India' => 'India',
      'Canada' => 'Canada',
      'Belarus' => 'Belarus',
      'Germany' => 'Germany',
      'Israel' => 'Israel',
      'Japan' => 'Japan',
      'Korea' => 'Korea',
      'Philippines' => 'Philippines',
      'Ukraine' => 'Ukraine',
      'United States' => 'United States',

    ];

    $languages = [
      'en' => 'English',
      'fr' => 'French',
      'de' => 'German',
      'pt' => 'Portuguese',
    ];

    $timeZones = [
      'GMT-12' => '(GMT-12:00) International Date Line West',
      'GMT-11' => '(GMT-11:00) Midway Island, Samoa',
      'GMT-10' => '(GMT-10:00) Hawaii',
      'GMT-9' => '(GMT-9:00) Alaska',
      'GMT-8' => '(GMT-8:00) Tijuana',
      'GMT-7' => '(GMT-7:00) Arizona',
      'GMT-6' => '(GMT-6:00) Central America',
      'GMT-5' => '(GMT-5:00) Bogota',
      'GMT-4' => '(GMT-4:00) Atlantic Time (Canada)',
    ];

    $currencies = [
      'usd' => 'USD',
      'euro' => 'Euro',
      'pound' => 'Pound',
      'bitcoin' => 'Bitcoin',
    ];
    $users = user::findOrFail($id);
    return view('content.users.users-update', 
    [ 'user' => $users,
      'countries' => $countries,
      'languages' => $languages,
      'timeZones' => $timeZones,
      'currencies' => $currencies,
    ]);
  }

  public function edit(Request $request)
  {
    $currentDateTime = Carbon::now();
    $request->validate([
      'username' => 'required|string',
      'first_name' => 'required|string',
      'last_name' => 'nullable|string',
      'email' => 'required|email|unique:users,email,' . $request->id,
      'organization' => 'nullable|string',
      'phone_number' => 'nullable|string',
      'address' => 'nullable|string',
      'state' => 'nullable|string',
      'zip_code' => 'nullable|string',
      'country' => 'nullable|string',
      'language' => 'nullable|string',
      'time_zones' => 'nullable|string',
      'currency' => 'nullable|string',
    ]);

    $userData = [
      'username' => $request->username,
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'organization' => $request->organization,
      'phone_number' => $request->phone_number,
      'address' => $request->address,
      'state' => $request->state,
      'zip_code' => $request->zip_code,
      'country' => $request->country,
      'language' => $request->language,
      'time_zones' => $request->time_zones,
      'currency' => $request->currency,
      'active' => 1,
      'updated_at'=>$currentDateTime,
    ];

    if ($request->hasFile('avatar')) {
      $avatar = $request->file('avatar');
      $avatarPath = $avatar->store('avatars', 'public');
      $userData['profile_image'] = $avatarPath;
    }

    try {
      $user = User::findOrFail($request->id);
      $user->update($userData);
      return redirect()->route('users-list')->with('success', 'User updated successfully');
    } catch (\Exception $e) {
      \Log::error('Error updating user: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error updating user. Please try again.');
    }
  }
}
