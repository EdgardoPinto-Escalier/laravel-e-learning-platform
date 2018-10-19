@component('mail::message')

# {{ ("New Message from your teacher") }}

{{ $text_message }}

@component('mail::button', ['url' => url('/')])
    {{ __("GO TO :app", ['app' => config('app.name')]) }}
@endcomponent

{{ ("Thanks") }},<br>
{{ config('app.name') }}

@endcomponent
