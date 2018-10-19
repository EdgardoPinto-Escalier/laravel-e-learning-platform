@component('mail::message')

# {{ ("Hello, you have a new contact request!") }}

From: <strong>{{ $request->name }}</strong>

Email: <strong> {{ $request->email }} </strong>

{{ $request->message }}


{{ ("Thanks") }},<br>
{{ config('app.name') }}

@endcomponent