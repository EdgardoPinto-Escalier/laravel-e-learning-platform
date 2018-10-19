@component('mail::message')

# {{ ("Course Rejected!") }}

{{ __("Your course :course has not been approved on the platform.", ['course' => $course->name]) }}
<img class="img-responsive" src="{{ url('storage/courses/' . $course->picture) }}" alt="{{ $course->name }}"><!-- Here we add an image with the course image -->

<!-- We also create a button with the url of the site to go back to the webpage -->
@component('mail::button', ['url' => url('/')])
    {{ ("Go to the site") }}
@endcomponent

{{ ("Thank You!") }},<br>
{{ config('app.name') }}

@endcomponent
