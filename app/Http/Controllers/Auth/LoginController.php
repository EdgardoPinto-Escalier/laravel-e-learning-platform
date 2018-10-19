<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use App\UserSocialAccount;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Here we create the function logout(). Here we force to erase the session
    // using session()->flush();
    public function logout (Request $request) {
    	auth()->logout();
    	session()->flush();
      // After that we show a success message using the function flash().
      flash()->success('Success! - You have been logged out!');
      // Finally we redirect to the login page.
    	return redirect('/login');
    }

    // Here we create the function redirectToProvider(). Here using Socialite
    // we use the driver function, we pass the driver inside and then we
    // use the function redirect().
    public function redirectToProvider (string $driver) {
    	return Socialite::driver($driver)->redirect();
    }

    // Here we create the function handleProviderCall(). Next we use the request()
    // object to see if has the variables code or denied, if they are there, then we
    // show a flash message with the flash(9 function showing an error message.
    // Lastly we return redirect to /login.
    public function handleProviderCallback (string $driver) {
    	if( ! request()->has('code') || request()->has('denied')) {
    		flash()->error('Error! - Your login session has been cancelled!');
    		return redirect('/login');
      }
      
    // If there are no errors then we create a few variables first.
    $socialUser = Socialite::driver($driver)->user();
    $user = null;
    $success = true;
    $email = $socialUser->email;
    // Here we start using the DB looking for an user in particular and asking for the first registry.
    $check = User::whereEmail($email)->first();
    // Firsdt we check if the registry exist in the DB.
    if($check) {
      $user = $check; // We login the user without registering the user because it already exist in the DB.
    } else { // Otherwise...
      \DB::beginTransaction(); // We register the user in the DB using a transaction.
      // Here we use a try to do the following...
      try {
        // Using the User model and the create method we make an array with the data we want to insert in the users table.
        $user = User::create([
          "name" => $socialUser->name, // Here we insert the name of the user.
          "email" => $email // Here we insert the email of the user.
        ]);
        // Here we do the following...
        UserSocialAccount::create([
          "user_id" => $user->id, // The create method give us back the instance of the model so we have the user and the id of the user.
          "provider" => $driver, // The provider that the user has used (driver).
          "provider_uid" => $socialUser->id // This will be the identifier of the user in the platform that has been used.
        ]);
        // Here we use the classStudent and the method create.
        Student::create([
          "user_id" => $user->id // Here we make a relation between the new registry and a student so this way the $user will become an student.
        ]);
      // Here on the catch we use the class Exception
      } catch (\Exception $exception) {
      $success = $exception->getMessage();
      \DB::rollBack(); // In case of any errors, we use DB with rollback to erase everything has been made.
      }
    }
    // Here we do a commit so the details are persistent in the DB.
    // To do this we do a check, if success is equal to true it means there is not error and not catch of any exception.
    if($success === true) {
      // So, using the class DB we make a commit so all the infor above can be saved in the database.
      \DB::commit();
      auth()->loginUsingId($user->id); // Here using the method loginUsingId() we can start session with the user id.
      // Then we show a success message to the user...
      flash()->success('Success! - Your are logged in now using your Social Media account!');
      return redirect('/home'); // And return the /home page where we have the list with all the courses.
    }
    // Otherwise we show the error message.
    session()->flash('message', ['danger', $success]);
    return redirect('/login'); // Finally we return to the login page.
  }
}
