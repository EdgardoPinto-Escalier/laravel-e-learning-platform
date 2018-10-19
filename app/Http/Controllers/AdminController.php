<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\CourseApproved;
use App\Mail\CourseRejected;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	// First we define the first function courses(), this function will
	// return the view admin.courses, this view will show the component
	// that will be generated with VueTables 2.
	public function courses() {
		return view('admin.courses');
	}

	// Next we have the coursesJson() function.
	public function coursesJson() {
		// First we check if this is an ajax request we send the following info.
		if(request()->ajax()) {
			$vueTables = new EloquentVueTables; // We make here a new instance of EloquentVueTables and assign this to $vueTables
			$data = $vueTables->get(new Course, ['id', 'name', 'status'], ['reviews']);
			return response()->json($data);
		}
		// Otherwise we do an abort with a 401 code informing that the url can't be accessed.
		return abort(401);
	}

	public function updateCourseStatus() {
		if (\request()->ajax()) {
			$course = Course::find(\request('courseId'));
			//
			if(
				(int) $course->status !== Course::PUBLISHED &&
				! $course->previous_approved &&
				\request('status') === Course::PUBLISHED
			) {
				$course->previous_approved = true;
				\Mail::to($course->teacher->user)->send(new CourseApproved($course));
			}
			//
			if(
				//
				(int) $course->status !== Course::REJECTED &&
				! $course->previous_rejected &&
				\request('status') === Course::REJECTED
			) {
				$course->previous_rejected = true;
				\Mail::to($course->teacher->user)->send(new CourseRejected($course));
			}
			//
			$course->status = \request('status');
			$course->save();
			return response()->json(['msg' => 'ok']);
		}
		//
		return abort(401);
	}
	//
	public function students () {
		return view('admin.students');
	}
	//
	public function teachers () {
		return view('admin.teachers');
	}
}
