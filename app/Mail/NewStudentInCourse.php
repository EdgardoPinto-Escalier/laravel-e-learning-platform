<?php

namespace App\Mail;

use App\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewStudentInCourse extends Mailable
{
    use Queueable, SerializesModels;
    /**
    * @var Course
    */

    // First we declare/initialize the variables we'll use.
    private $course;
    private $student_name;
    

    /**
     * Create a new message instance.
     *
     *@param Course $course
     *@param $student_name
     *
     */

    // Here we add some parameters to the constructor like the course and the student name.
    public function __construct(Course $course, $student_name)
    {
       $this->course = $course;
       $this->student_name = $student_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    // This is the build() function, in charge of send the message.
    public function build()
    {
        // Here we return the contents of the email.
        return $this
          ->subject(__("A new student has been enrolled in your course!"))
          ->markdown('emails.newStudentInCourse')
          ->with('course', $this->course)
          ->with('student', $this->student_name);
    }
}
