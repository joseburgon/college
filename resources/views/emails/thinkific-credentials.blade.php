@component('mail::message')
<img src="https://checkout.livingroomcollege.org/img/bienvenido.png" class="welcome-img" alt="Bienvenido a bordo">

Hola {{ $user['first_name'] }}, estamos felices de contar contigo en este nuevo curso.
Prepárate para que tu vida sea llevada al Diseño original de Dios de prosperidad y abundancia.

El lunes 31 de agosto podrás ingresar al curso e iniciar las clases.

Estas son tu credenciales de acceso a la plataforma.

## Usuario:
{{ $user['email'] }}

@if (isset($user['password']))
## Contraseña:
{{ $user['password'] }}
@endif


Y este es el link de acceso a la plataforma:

@component('mail::button', ['url' => 'https://cursos.livingroomcollege.org/users/sign_in'])
Iniciar Sesión
@endcomponent


Te recomendamos asignar una nueva clave después de iniciar sesión.

Nos vemos en clase,<br>
Team LVR College
@endcomponent
