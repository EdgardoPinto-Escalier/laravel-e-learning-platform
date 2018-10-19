<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

// Here we write the first route that will make a petition of type (get) to login
// then, we pass a variable (driver) this can be facebook, twitter or github.
// After that this will go to the LoginController and will call the function
// redirectToProvider, the we add a name 'social_auth'
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
// The second route is for the petition of the social media when makes
// a petition back to the application. This petition will be processed by then
// function handleProviderCallback of the LoginController.
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');
// Route for the logout of the users in the site.
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

// Basic route to get the static welcome page.
Route::get('/', function() {
    return view('welcome');
});


Auth::routes();

// This is the main route to the application.
Route::get('/home', 'HomeController@index')->name('home');

// Here we add the routes to find the images on this app.
Route::get('/images/{path}/{attachment}', function($path, $attachment) {
	$file = sprintf('storage/%s/%s', $path, $attachment);
	if(File::exists($file)) {
		return Image::make($file)->response();
	}
});


// Here we add the routes for the courses.
Route::group(['prefix' => 'courses'], function() {

	Route::group(['middleware' => ['auth']], function() {
		Route::get('/subscribed', 'CourseController@subscribed')->name('courses.subscribed');
		Route::get('/{course}/enrollToCourse', 'CourseController@enrollToCourse')->name('courses.enrollToCourse');
		Route::post('/add_review', 'CourseController@addReview')->name('courses.add_review');

    // Here we group all the routes together by using the function resource()
    // this function has all the methods (GET, POST, PUT and DELETE).
    Route::group(['middleware' => [sprintf('role:%s', \App\UserRole::TEACHER)]], function() {
 			Route::resource('courses', 'CourseController');
 		});

	});
	Route::get('/{course}', 'CourseController@show')->name('courses.detail');
});


// Here we have all the routes to access and administrate the invoices we get from stripe.
Route::group(['middleware' => ['auth']], function () {
	Route::group(["prefix" => "subscriptions"], function() {
		Route::get('/plans', 'SubscriptionController@plans')
		     ->name('subscriptions.plans');
		Route::get('/admin', 'SubscriptionController@admin')
		     ->name('subscriptions.admin');
		Route::post('/process_subscription', 'SubscriptionController@processSubscription')
		     ->name('subscriptions.process_subscription');
		Route::post('/resume', 'SubscriptionController@resume')->name('subscriptions.resume');
		Route::post('/cancel', 'SubscriptionController@cancel')->name('subscriptions.cancel');
	});
  // Here we have the routes for the invoices (admin and download)
	Route::group(['prefix' => "invoices"], function() {
		Route::get('/admin', 'InvoiceController@admin')->name('invoices.admin');
		Route::get('/{invoice}/download', 'InvoiceController@download')->name('invoices.download');
	});
});


// Here we have all the subscription routes.
Route::group(["prefix" => "subscriptions"], function() {
		Route::get('/plans', 'SubscriptionController@plans')
		     ->name('subscriptions.plans');
		Route::get('/admin', 'SubscriptionController@admin')
		     ->name('subscriptions.admin');
		Route::post('/process_subscription', 'SubscriptionController@processSubscription')
		     ->name('subscriptions.process_subscription');
    // The following is the route to resume the user subscription to the plan.
		Route::post('/resume', 'SubscriptionController@resume')->name('subscriptions.resume');
    // The following is the route to cancel the user subscription to the plan.
		Route::post('/cancel', 'SubscriptionController@cancel')->name('subscriptions.cancel');
	});

// Here we have the user profile routes.
Route::group(["prefix" => "profile", "middleware" => ["auth"]], function() {
	Route::get('/', 'ProfileController@index')->name('profile.index');
	Route::put('/', 'ProfileController@update')->name('profile.update');
});

// Here we create the routes for the user when wants to become a teacher.
Route::group(['prefix' => "solicitude"], function() {
	Route::post('/teacher', 'SolicitudeController@teacher')->name('solicitude.teacher');
});

// Here we create the routes for the teacher (his courses, students and the route to send a message to the student).
Route::group(['prefix' => "teacher", "middleware" => ["auth"]], function() {
	Route::get('/courses', 'TeacherController@courses')->name('teacher.courses'); //Route to see the teacher courses.
	Route::get('/students', 'TeacherController@students')->name('teacher.students'); //Route to see the teacher students.
	Route::post('/send_message_to_student', 'TeacherController@sendMessageToStudent')->name('teacher.send_message_to_student');
});

//Finally we have all the admin routes here, as we can see they have the role Admin and the auth middleware.
Route::group(['prefix' => "admin", "middleware" => ['auth', sprintf("role:%s", \App\UserRole::ADMIN)]], function() {
	Route::get('/courses', 'AdminController@courses')->name('admin.courses');
	Route::get('/courses_json', 'AdminController@coursesJson')->name('admin.courses_json');
	Route::post('/courses/updateStatus', 'AdminController@updateCourseStatus');
	
  // These routes are ready for the next version of the application (currently not in use)
	Route::get('/students', 'AdminController@students')->name('admin.students');
	Route::get('/students_json', 'AdminController@studentsJson')->name('admin.students_json');
	Route::get('/teachers', 'AdminController@teachers')->name('admin.teachers');
	Route::get('/teachers_json', 'AdminController@teachersJson')->name('admin.teachers_json');
});

// Here are the routes for the contact form.
Route::get('contact', 'ContactController@showContactForm')->name('contact');
Route::post('contact', 'ContactController@mailContactForm');

// Basic route to get the static about page.
Route::get('/about', function() {
	return view('about');
});
 