<?php

namespace App\Policies;

use App\UserRole;
use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function opt_for_course(User $user, Course $course) {
    	return ! $user->teacher || $user->teacher->id !== $course->teacher_id;
    }

    public function subscribe(User $user) {
    	return $user->role_id !== UserRole::ADMIN && ! $user->subscribed('LearnToCode');
    }

    public function enrollToCourse(User $user, Course $course) {
    	return ! $course->students->contains($user->student->id);
    }

	public function review(User $user, Course $course) {
		return ! $course->reviews->contains('user_id', $user->id);
	}
}
