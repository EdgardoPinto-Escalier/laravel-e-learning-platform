<?php
namespace App\Helpers;

// Here we create the class HelperClass
class HelperClass {
  // Next we create the function uploadFile() and we pass a key and a path.
	public static function uploadFile($key, $path) {
    // Here we do a request-file with the key and we will save it using store() on the $path.
		request()->file($key)->store($path);
    // Finally we return the file that was saved.
		return request()->file($key)->hashName();
	}
}
