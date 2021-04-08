@component('mail::message')
# Olá, {{ $user->name }}

Você solicitou a recuperação de sua senha,

Clique no link abaixo para confirmar sua identidade e criar uma nova senha.

@component('mail::button', ['url' => $url])
Recuperar Senha
@endcomponent

Caso o link acima não funcionar copie o código e cole no seu navegador
 [{{ $url  }}]({{ $url }}),

<br>

Caso você não tenha feito esta solicitação, apenas ignore este email.

<br>

{{ env('APP_NAME') }}
@endcomponent
ta me devendo a bunda agora  (____O____) ta aí a bunda
