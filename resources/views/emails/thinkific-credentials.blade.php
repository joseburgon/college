@component('mail::message')
# ¡Bienvenido a bordo!

Estas son tu credenciales de acceso a la plataforma.

## Usuario:
micorreo@mail.com

## Contraseña:
P3erkdwoiw


@component('mail::button', ['url' => 'https://cursos.livingroomcollege.org/users/sign_in'])
Iniciar Sesión
@endcomponent


Te recomendamos asignar una nueva clave después de iniciar sesión.

Nos vemos en clase,<br>
{{ config('app.name') }}
@endcomponent
