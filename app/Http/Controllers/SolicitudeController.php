<?php

namespace App\Http\Controllers;

use App\UserRole;
use App\Teacher;
use Illuminate\Http\Request;

class SolicitudeController extends Controller
{
    // First we create the function teacher()
    public function teacher() {
      // Here we get the user.
    	$user = auth()->user();
      // We do a small check to see if the user is not a teacher...
    	if ( ! $user->teacher) {
    		try {
          // Here inside the try using the DB we will start a transaction
			    \DB::beginTransaction();
          // Here we'll change the role from user to teacher
			    $user->role_id = UserRole::TEACHER;
          // Then, from the TEACHER model we'll create a new instance
			    Teacher::create([
            // And we say that 'user_id' => $user->id
			    	'user_id' => $user->id
			    ]);
          // If everything went ok we assign true to the variable $success.
			    $success = true;
          // Is something goes wrong, using Exception we'll access to the DB
          // and will do a rollback of the current operation.
		    } catch (\Exception $exception) {
    			\DB::rollBack();
          // Otherwise, $success is equal to $exception
    			$success = $exception->getMessage();
		    }

        // Then here we make another check to see if $success is equal to true
		    if ($success === true) {
          // Then, we use the DB and make a commit to confirm all changes.
    			\DB::commit();
          // We logout the user to update the session.
    			auth()->logout();
          // Then we start session with the user again.
    			auth()->loginUsingId($user->id);
          // We show a success message to the user.
          flash()->success('Success! - Congratulations, you are now an instructor on this platform!');
          // Finally we send the user back where he was before.
			    return back();
		    }
	    }
      // Otherwise we show an error message to the user.
      flash()->error('Error - Something went wrong...');
	    return back();
    }
}
