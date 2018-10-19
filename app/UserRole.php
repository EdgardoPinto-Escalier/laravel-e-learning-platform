<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserRole
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserRole extends Model
{
  // Here we define the 3 user roles for this application.
  const ADMIN = 1;
  const TEACHER = 2;
  const STUDENT = 3;
}
