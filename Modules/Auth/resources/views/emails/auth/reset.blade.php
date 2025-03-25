<x-mail::message>
Hello!

A password reset for the account associated with this email has been
requested.

Please enter the below in your password reset page

{{ $code }}

if you did not request a password reset, please ignore this message.
{{--  <x-mail::button :url="''">
Button Text
</x-mail::button>  --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
