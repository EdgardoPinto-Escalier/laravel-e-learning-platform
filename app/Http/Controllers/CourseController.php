<?php

namespace App\Http\Controllers;

use App\Course;
use App\Helpers\HelperClass;
use App\Http\Requests\CourseRequest;
use App\Mail\NewStudentInCourse;
use App\Review;


class CourseController extends Controller
{
  public function show(Course $course) {
		$course->load([
			'category' => function ($q) {
				$q->select('id', 'name');
			},
			'goals' => function ($q) {
				$q->select('id', 'course_id', 'goal');
			},
			'level' => function ($q) {
				$q->select('id', 'name');
			},
			'requirements' => function ($q) {
				$q->select('id', 'course_id', 'requirement');
			},
			'reviews.user', //Here we access to all the reviews of the course.
			'teacher' //Here we access to the teacher's details.
		])->get();

		$related = $course->relatedCourses();

		return view('courses.detail', compact('course', 'related'));
	}


	//Here we create the function enrollToCourse
	public function enrollToCourse(Course $course) {
    //Here we access to the table course/students and we insert a new registry (student ID).
		$course->students()->attach(auth()->user()->student->id);
    //Here we sent the mail to the teacher.
		\Mail::to($course->teacher->user)->send(new NewStudentInCourse($course, auth()->user()->name));
    //Here we return back with a success message.
    flash()->success('Success! - You have been enrolled to this course!');
    return back();
	}

  // Here we create the function susbscribed
  public function subscribed() {
    // Here we look for a course that has students, also inside the studentsJson
    // it will look for a student with the same ID (me).
		$courses = Course::whereHas('students', function($query) {
			$query->where('user_id', auth()->id());
		})->get(); // Then with the method get() we return the view courses/subscribed.
		return view('courses.subscribed', compact('courses'));
	}

  // Here we create the function addReview().
  public function addReview() {
    // Here using the class Review with the function create we pass
    // an array with the following details.
		Review::create([
			"user_id" => auth()->id(),
			"course_id" => request('course_id'),
			"rating" => (int) request('inputForRatings'),
			"comment" => request('message')
		]);
    // Finally we show a success message using the flash() function.
    flash()->success('Success! - Thanks for adding your review!');
		return back(); // and return the user back the the page.
	}

  // Here we create the function create() for creating new courses.
  public function create() {
    // First we create a new instance of course.
		$course = new Course;
    // Here we assign the text to the button $btnText.
		$btnText = ("SUBMIT COURSE FOR REVIEW");
    // Then, we return the view courses/form and with compact() we pass in course and btnText.
		return view('courses.form', compact('course', 'btnText'));
	}

  // Next we create the function store(). Here we pase CourserRequest to get access to all the data.
  public function store(CourseRequest $course_request) {
    // Here using uploadFile() we say that picture is the file name
    // and path is courses (courses directory)
		$picture = HelperClass::uploadFile('picture', 'courses');
    // Here inside the $course_request petition will exist a NEW
    // variable with the name of picture and will have the same value as $picture.
    // We do this to have the right formatt in the DB.
		$course_request->merge(['picture' => $picture]);
    // Next we get the teacher ID and we merge the information as well.
		$course_request->merge(['teacher_id' => auth()->user()->teacher->id]);
    // Next we give a status of PENDING to the course.
		$course_request->merge(['status' => Course::PENDING]);
    // Here we insert in the table all the information we need about the courses
    // thanks to $course_request.
		Course::create($course_request->input());
    // Finally we show a success message using flash().
    flash()->success('Success! - The course has been submitted for review!');
    // Then we return back to the previous page.
		return back();
	}

  // Next we create the function edit() where we pass the slug.
  public function edit($slug) {
    // Next we get the course and change to edition mode (form)
    // For this first we get the course with requirements and goals everything with count.
    // We do this so we don't get duplicated requests.
		$course = Course::with(['requirements', 'goals'])->withCount(['requirements', 'goals'])
      // Here we get the first slug with whereSlug, first.
			->whereSlug($slug)->first();
    // Next we define the button to edit the course we got above.
		$btnText = __("EDIT COURSE DETAILS");
    // Finally we return the view courses/form and we pass in the course and the button.
		return view('courses.form', compact('course', 'btnText'));
	}

  // Next we create the function update() this function will be used by the format
  // to update the new information after edition of the course. Here we pase the $course_request and the $course.
	public function update(CourseRequest $course_request, Course $course) {
    // First we check if inside the object request exist a file with the name of picture...
		if($course_request->hasFile('picture')) {
      // If exists then we use the delete() function and eliminate the current picture of the course.
      // by doing this with delete the previous image we have uploaded before.
			\Storage::delete('courses/' . $course->picture);
      // Next using the HelperClass we upload a new file (picture) on the path courses.
			$picture = HelperClass::uploadFile( "picture", 'courses');
      // Here using $course_request we merge the picture using an array.
			$course_request->merge(['picture' => $picture]);
		}
    // Here using the fill() function we update the whole form.
		$course->fill($course_request->input())->save();
    // Finally we send a success message to the user.
    flash()->success('Success! - The course has been updated!');
    // and we return back to the page.
		return back();
	}

  // Next we create the function destroy() to erase courses, so we pass in the course.
	public function destroy(Course $course) {
    // Next we use a try catch
		try {
      // If the course has been deleted...
			$course->delete();
      // We show a success message...
      flash()->success('Success! - The course has been deleted!');
			return back(); // and return back to the page.
		} catch (\Exception $exception) { // If there is a problem we catch it
      flash()->error('Oops! - Error deleting course...'); // and we show the error message
			return back(); // Finally we return back to the page.
		}
	}

}
