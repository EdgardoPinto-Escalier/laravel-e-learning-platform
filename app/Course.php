<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Course
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $category_id
 * @property int $level_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
  use SoftDeletes;

  protected $fillable = ['teacher_id', 'name', 'description', 'picture', 'level_id', 'category_id', 'status'];

  // Here we assign the 3 course status.
  const PUBLISHED = 1;
  const PENDING = 2;
  const REJECTED = 3;

  protected $withCount = ['reviews', 'students'];

  // Here we define the static function boot()
  public static function boot() {
		parent::boot();

    // Here we create the static event saving()
    // What we do here basically is right before the information has been saved
    // we define the slug using the "-"
		static::saving(function(Course $course) {
			if( ! \App::runningInConsole() ) {
				$course->slug = str_slug($course->name, "-");
			}
		});

    // Here we will define the static event saved (updating or creating)
		static::saved(function (Course $course) {
			if ( ! \App::runningInConsole()) { // if we are not executing this on the console...
				if ( request('requirements')) { // if it has requirements...
          // We make a foreach to loop through request requirements with the $key (index)
          // and $requirement_input (the value).
					foreach (request('requirements') as $key => $requirement_input) {
						if ($requirement_input) { // Here we check if we have value...
              // We use updateOrCreate() to see if exist or if not we will create it.
							Requirement::updateOrCreate(['id' => request('requirement_id'. $key)], [
                // What exactly we'll update or create? The following:
								'course_id' => $course->id,
								'requirement' => $requirement_input
							]);
						}
					}
				}
        // Next we do exactly the same with goals.
				if(request('goals')) {
					foreach(request('goals') as $key => $goal_input) {
						if( $goal_input) {
							Goal::updateOrCreate(['id' => request('goal_id'.$key)], [
								'course_id' => $course->id,
								'goal' => $goal_input
							]);
						}
					}
				}
			}
		});
	}

  // Here we create the function pathAttachment() for the pictures.
  public function pathAttachment() {
    return "/images/courses/" . $this->picture;
  }

  // Here we create the function getRouteKeyName() and we return the slug.
  public function getRouteKeyName() {
    return 'slug';
  }

   // Here in the following section we will establish the
   // relationships in Elocuent as showed below:

   // First we define the function category. Here by using
   // belongsTo we tell it that belongs to Category selecting only id and name.
   // (For example One course belongs to a category)
   public function category() {
     return $this->belongsTo(Category::class)->select('id', 'name');
   }

   // Next we create the function goals. One course has many goals,
   // and here using select we get the id, course_id and goal.
   // Why we select course_id if we have already the id? Well because
   // we have established a relationship and we have to pass always them
   // the primary key and the foreign keys also.
   public function goals() {
     return $this->hasMany(Goal::class)->select('id', 'course_id', 'goal');
   }

   // Next we create the function level. Same thing but using belongsTo.
   public function level() {
     return $this->belongsTo(Level::class)->select('id', 'name');
   }

   // Here we create the function reviews. One course can have many reviews
   // We use the class reviews and select the fields we need.
   public function reviews() {
     return $this->hasMany(Review::class)->select('id', 'user_id', 'course_id', 'rating', 'comment', 'created_at');
   }

   // Next we create the function requirements. Here we return this hasMany and
   // the related model is Requirement, finally we select id and course_id
   // (primary and foreign key and requirement).
   public function requirements() {
     return $this->hasMany(Requirement::class)->select('id', 'course_id', 'requirement');
   }

   // Next we create the function students(). Here we use belongsToMany.
   // In one course can be enrolled many students.
   public function students() {
     return $this->belongsToMany(Student::class);
   }

   // Next we create the function teacher(). Here we use belongsTo and the model is Teacher.
   // One course belongs to a teacher.
   public function teacher() {
     return $this->belongsTo(Teacher::class);
   }

   // And finally we create the function getNewRatingAttribute().
   public function getNewRatingAttribute() {
     return $this->reviews->avg('rating');
   }

   /**
  * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
  */

  // Finally we create the function relatedCourses() to show related courses.
  public function relatedCourses() {
    return Course::with('reviews')->whereCategoryId($this->category->id)
        ->where('id', '!=', $this->id)
        ->orwhere('id', '!=', $this->category->id)
        ->where('status', Course::PUBLISHED)
        ->latest()
        ->limit(6)
        ->get();
      }
}
