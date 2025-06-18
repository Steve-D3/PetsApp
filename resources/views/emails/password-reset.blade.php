@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

# Password Reset Request

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $resetUrl, 'color' => 'primary'])
Reset Password
@endcomponent


If you did not request a password reset, no further action is required.

For security reasons, this link will expire in {{ $expire }} minutes or until you request another password reset.

If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:

[{{ $resetUrl }}]({{ $resetUrl }})

@slot('footer')
@component('mail::footer')
&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.

@component('mail::subcopy')
If you're having trouble with the button above, copy and paste the URL below into your web browser:
[{{ $resetUrl }}]({{ $resetUrl }})
@endcomponent
@endcomponent
@endslot
@endcomponent
