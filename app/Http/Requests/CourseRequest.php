<?php

namespace App\Http\Requests;

use App\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Here we confirm that the user making this petition has to have the role TEACHER.
        return auth()->user()->role_id === UserRole::TEACHER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Here we use a switch statement to change the methods'
        // depending if the user is posting or editing content.
        switch ($this->method()) {
          // If there is a GET or DELETE we return an empty array
          // because we don't want to apply any rules.
	        case 'GET':
	        case 'DELETE':
		        return [];
          // If we get a POST request...
	        case 'POST': {
            // We do a return with an array containing the following rules...
	        	return [
	        	  'name' => 'required|min:5',
			        'description' => 'required|min:30',
              // Level is required and has an array where we
              // make sure that the level is the same as in the levelS table in the DB.
			        'level_id' => [
			        	'required',
				        Rule::exists('levels', 'id')
			        ],
                // Also has a category that is required and we do the
                // same check as with levels in the DB.
		            'category_id' => [
			            'required',
			            Rule::exists('categories', 'id')
		            ],
              // The picture field is required also and we list here then
              // image types.
			        'picture' => 'required|image|mimes:jpg,jpeg,png',
              // We also make a small check for the requirements
              // If field 2 has a value field 1 must have a value also.
			        'requirements.0' => 'required_with:requirements.1',
              // Same thing for the goals.
			        'goals.0' => 'required_with:goals.1',
		        ];
	        }
          // If the request is PUT...
	        case 'PUT': {
            // We return an array with the following rules...
            // Here we do exactly the same but with some changes on the picture validation part.
		        return [
			        'name' => 'required|min:5',
			        'description' => 'required|min:30',
			        'level_id' => [
				        'required',
				        Rule::exists('levels', 'id')
			        ],
			        'category_id' => [
				        'required',
				        Rule::exists('categories', 'id')
			        ],
              // Here we use 'sometimes' what this does?
              // This will on PUT respect the image type but readonly
              // when picture has been sent and is inside the object request array.
			        'picture' => 'sometimes|image|mimes:jpg,jpeg,png',
			        'requirements.0' => 'required_with:requirements.1',
			        'goals.0' => 'required_with:goals.1',
		        ];
	        }
        }
    }
}
