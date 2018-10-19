<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Goal
 *
 * @property int $id
 * @property int $course_id
 * @property string $goal
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Goal extends Model
{
  // Here as well we use $fillable so we don't have any problems.
  protected $fillable = ['course_id', 'goal'];

  // Here we create the function course(). A goal belongsTo a course.
  public function course() {
    return $this->belongsTo(Course::class);
  }
}
