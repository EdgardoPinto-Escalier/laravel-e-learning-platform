@component('mail::message')

# {{ ("Course Approved!") }}

{{ __("Your course :course has been approved and is already published on the platform", ['course' => $course->name]) }}
<img class="img-responsive" src="{{ url('storage/courses/' . $course->picture) }}" alt="{{ $course->name }}"><!-- Here we add an image with the course image -->

<!-- We also create a button with the url of the course that has been approved -->
@component('mail::button', ['url' => url('/courses/' . $course->slug)])
    {{ ("Go to the course") }}
@endcomponent

{{ ("Thank You!") }},<br>
{{ config('app.name') }}

@endcomponent
