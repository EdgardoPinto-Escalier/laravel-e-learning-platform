<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Student
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUserId($value)
 * @mixin \Eloquent
 */
class Student extends Model
{
  protected $fillable = ['user_id', 'title'];

  // Here using $appends we will be able to return this with a get() function.
  protected $appends = ['courses_formatted'];

  // Here we create the function courses. This will have a belongsToMany relation.
  // One student belongs to many courses.
  public function courses() {
    return $this->belongsToMany(Course::class);
  }

  // Next we create the function user().
  public function user() {
 		return $this->belongsTo(User::class)->select('id', 'role_id', 'name', 'email');
 	}

  // Next we create the function getCoursesFormattedAttribute()
  public function getCoursesFormattedAttribute () {
      // Here we will return the courses and using pluck()
      // we'll use the columns we need to return only.
    	return $this->courses->pluck('name')->implode('<br />');
	}

}
