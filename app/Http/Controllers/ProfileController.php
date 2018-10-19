<?php

namespace App\Http\Controllers;

use App\User;
use App\Rules\StrengthPassword;
use App\Helpers\HelperClass;
use App\Http\Requests\UserRequest;


class ProfileController extends Controller
{
    // First we define the function index()
    public function index() {
      // Here we get the user loaded with the relation SocialAccount, we assign
      // this user to the variable $user.
    	$user = auth()->user()->load('socialAccount');
      // Then, we return the the view profile/index passing the user.
    	return view('profile.index', compact('user'));
    }

    // Next we define the update() function.
    public function update() {
    // Here we use validate where we pass the object request and the
    // rules inside an array. The password has to be confirmed all THIS
    // with a new instance of the StrengthPassword class.
		$this->validate(request(), [
			'password' => ['confirmed', new StrengthPassword]
		]);
    // Next, get get the user.
		$user = auth()->user();
    // Next we get the password and we encrypt it using bcrypt.
		$user->password = bcrypt(request('password'));
    // Finally we save the user.
		$user->save();

    // If everything went ok we show a success message using the flash() function.
    flash()->success('Success! - Your password have been updated successfully!');
	    return back(); // Lastly we return back to the page.
    }
}
