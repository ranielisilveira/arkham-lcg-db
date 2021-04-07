@component('mail::message')
# Olá, {{ $user->name }}

Bem vindo,

Clique no link abaixo para confirmar sua conta.

@component('mail::button', ['url' => $url])
Confirmar conta
@endcomponent

Caso o link acima não funcionar, copie o código e cole no seu navegador
[{{ $url }}]({{ $url }}),

<br>
{{ env('APP_NAME') }}
@endcomponent
