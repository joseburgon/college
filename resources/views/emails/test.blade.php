@component('mail::message')
<img src="{{ asset('/img/bienvenido.jpg') }}" class="welcome-img" alt="Bienvenido a bordo">

Estas son tu credenciales de acceso a la plataforma.

## Usuario:
joseph@mailinator.com

## Contraseña:
S3cr3tPassw0rd


@component('mail::button', ['url' => 'https://cursos.livingroomcollege.org/users/sign_in'])
Iniciar Sesión
@endcomponent


Te recomendamos asignar una nueva clave después de iniciar sesión.

Nos vemos en clase,<br>
{{ config('app.name') }}
@endcomponent
