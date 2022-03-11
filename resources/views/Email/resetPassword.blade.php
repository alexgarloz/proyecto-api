@component('mail::message')
    Hola:<br><br>
    Hemos recibido una petición para restablecer la contraseña de la cuenta de Remote Service.
    @component('mail::button', ['url' => 'http://localhost:4200/auth/change-password?token='.$token])
        Cambiar Contraseña
    @endcomponent
    Si no has solicitado restablecer tu contraseña, ignora este email.<br><br>
    Gracias, <br>
    {{ config('app.name') }}
@endcomponent


