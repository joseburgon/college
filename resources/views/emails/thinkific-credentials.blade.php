@component('mail::message')
# ¡Bienvenido a bordo!

Estas son tu credenciales de acceso a la plataforma.

## Usuario:
{{ $user['email'] }}

## Contraseña:
{{ $user['password'] }}


@component('mail::button', ['url' => 'https://cursos.livingroomcollege.org/users/sign_in'])
Iniciar Sesión
@endcomponent


Te recomendamos asignar una nueva clave después de iniciar sesión.

Nos vemos en clase,<br>
{{ config('app.name') }}
@endcomponent
