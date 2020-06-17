Hello {{$user->name}}
to verify your account using this link:
{{route('verify', $user->verification_token)}}
@component('mail::message')
# Hello {{$user->name}}

to verify your account using the button below

@component('mail::button', ['url' => route('verify', $user->verification_token) ])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent