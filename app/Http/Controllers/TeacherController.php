<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\MessageToStudent;
use App\Student;
use App\User;

class TeacherController extends Controller
{
	// Here we create the function courses().
	public function courses() {
		// Next we obtain all courses from a teacher.
		$courses = Course::withCount(['students'])->with('category', 'reviews')
			->whereTeacherId(auth()->user()->teacher->id)->latest()->paginate(8);
		// Then we return the view teachers/courses and we pass the courses.
		return view('teachers.courses', compact('courses'));
	}
    // Next we create the function students() to get all the students from a teacher.
    public function students() {
    // Here we use with to get the relationships (user and courses reviews)
		$students = Student::with('user', 'courses.reviews')
			// Next, we use whereHas to have courses using query builder.
			->whereHas('courses', function ($q) {
				// Here we use where to get the students
				$q->where('teacher_id', auth()->user()->teacher->id)->select('id', 'teacher_id', 'name')->withTrashed();
			})->get();
		// Here we create action column
		$actions = 'students.datatables.actions';
		// Then, we return datatables of the students. Also we add the column 'actions'
		// after that using rawColumn() we pass an array with actions and courses_formatted and
		// using make() true to convert this to datatable.
		return \DataTables::of($students)->addColumn('actions', $actions)->rawColumns(['actions', 'courses_formatted'])->make(true);
    }

		// Next we create the function sendMessageToStudent()
    public function sendMessageToStudent() {
			// Here we get the information we sent via ajax.
    	$info = \request('info');
			// Here we declare $data as an empty array.
    	$data = [];
			// Here we parse the string and place the information we have in $info into $data.
    	parse_str($info, $data);
			// Next we get into the user and look via his ID. (data.id)
    	$user = User::findOrFail($data['user_id']);
			// Next using a try catch we will send the mail to the user with the send() function
			// using a new instance of MessageToTheStudent where we will pass the teacher's user name
			// and the message.
    	try {
    		\Mail::to($user)->send(new MessageToStudent( auth()->user()->name, $data['message']));
    		$success = true; // If all goes OK.
				// If not, we catch the exception and say that $success is false.
	    } catch (\Exception $exception) {
    		$success = false;
	    }
			// Finally we return the response.
    	return response()->json(['res' => $success]);
    }
}
