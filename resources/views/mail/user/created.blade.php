@component('mail::message')
# {{ __('emails.user_created.greeting', ['name' => $user->first_name]) }}

{{ __('emails.user_created.body') }}

### {{ __('emails.user_created.password_label') }}
**{{ $password }}**

@component('mail::button', ['url' => route('login')])
{{ __('emails.user_created.login_button') }}
@endcomponent

{{ __('emails.user_created.reset_password_notice') }}

{{ __('emails.user_created.thank_you') }},<br>
{{ config('app.name') }}
@endcomponent
