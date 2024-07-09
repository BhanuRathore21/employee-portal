<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserData;
use App\Models\User;

class AccountSettingsAccount extends Controller
{
  public function index()
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

    $userId = Auth::id();
    $userData = UserData::where('id', $userId)->first();
    return view('content.pages.pages-account-settings-account', [
      'userData' => $userData,
      'countries' => $countries,
      'languages' => $languages,
      'timeZones' => $timeZones,
      'currencies' => $currencies,
    ]);
  }
  public function save_setting(Request $request)
  {
    $request->validate([
      'firstName' => 'required|string|max:255',
      'lastName' => 'required|string|max:255',
      'email' => 'required|email',
      'organization' => 'nullable|string|max:255',
      'phoneNumber' => 'nullable|string|max:255',
      'address' => 'nullable|string|max:255',
      'state' => 'nullable|string|max:255',
      'zipCode' => 'nullable|string|max:6',
      'country' => 'nullable|string|max:255',
      'language' => 'nullable|string|max:255',
      'timeZones' => 'nullable|string|max:255',
      'currency' => 'nullable|string|max:255',
      'avatar' => 'nullable|image|mimes:jpeg,png|max:800',
    ]);
    $userId = Auth::id();
    $userData = UserData::where('id', $userId)->first();
    if (!$userData) {
      $userData = new UserData();
      $userData->id = $userId;
    }
    // dd($request);
    $userData->first_name = $request->input('firstName');
    $userData->last_name = $request->input('lastName');
    $userData->email = $request->input('email');
    $userData->organization = $request->input('organization');
    $userData->phone_number = $request->input('phoneNumber');
    $userData->address = $request->input('address');
    $userData->state = $request->input('state');
    $userData->zip_code = $request->input('zipCode');
    $userData->country = $request->input('country');
    $userData->language = $request->input('language');
    $userData->time_zone = $request->input('timeZones');
    $userData->currency = $request->input('currency');
    $userData->remember_token = $request->input('_token');
    if ($request->hasFile('avatar')) {
      $avatar = $request->file('avatar');
      $avatarPath = $avatar->store('avatars', 'public');
      $publicImagePath = $avatarPath;
      $userData = UserData::firstOrNew(['id' => auth()->id()]);
      $userData->profile_image = $publicImagePath;
    }
    $userData->save();
    return redirect()->back()->with('success', 'Account settings updated successfully.');
  }
  public function deactivate(Request $request)
  {
    $request->validate([
      'accountActivation' => 'required|accepted',
    ]);

    $userId = Auth::id();

    $user = User::find($userId);

    if (!$user) {
      return back()->with('error', 'User not found.');
    }
    $user->active = false;
    $user->save();
    return redirect()->route('pages.account.settings.account')->with('success', 'Your account has been deactivated.');
  }
}
