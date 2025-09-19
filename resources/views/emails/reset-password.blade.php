@component('mail::message')
# 🔐 Restablecer tu contraseña

Hola **{{ $user->name ?? 'usuario' }}**,

Recibimos una solicitud para restablecer la contraseña de tu cuenta en **WualterMOTOS**.
Haz clic en el botón para continuar:

@component('mail::button', ['url' => $url])
Restablecer contraseña
@endcomponent

> Si no solicitaste este cambio, simplemente ignora este correo.

Gracias por confiar en WalterMotos.

@endcomponent
