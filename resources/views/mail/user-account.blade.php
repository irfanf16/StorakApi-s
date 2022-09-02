@component('mail::message')
    # Account Detail

    Your email is : {{ $email }}
    Your password is : {{ $pass }}


    @component('mail::button', ['url' => 'https://storak.qa/'])
        Login
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
