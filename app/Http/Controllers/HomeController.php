<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Here we can access to all the courses paginated and
        // we will see only the courses with the status PUBLISHED.
        $courses = Course::withCount(['students'])
          ->with('category', 'teacher', 'reviews')
          ->where('status', Course::PUBLISHED)
          ->latest() // The latest courses first.
          ->paginate(8); // Here we show 8 courses per page.

        // Then we return the home view, using the compact() php function
        // passing courses.
        return view('home', compact('courses'));
    }
}
