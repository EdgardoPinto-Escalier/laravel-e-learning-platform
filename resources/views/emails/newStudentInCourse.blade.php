@component('mail::message')
# {{ ("New student in your course!") }}


<img class="img-responsive" src="{{ url('storage/courses/' . $course->picture) }}" alt="{{ $course->name }}">

@component('mail::button', ['url' => url('/courses/' . $course->slug), 'color' => 'blue'])
    {{ ("Go To Course") }}
@endcomponent

{{ ("Thank you!") }},<br>
{{ config('app.name') }}

@endcomponent
