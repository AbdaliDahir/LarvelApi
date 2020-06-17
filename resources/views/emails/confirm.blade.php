@component('mail::message')
# Hello {{$user->name}}

your email was click the link below to confirm the new one:

@component('mail::button', ['url' => route('verify', $user->verification_token) ])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent