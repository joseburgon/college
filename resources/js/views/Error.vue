<template>
    <div>
        <px-header></px-header>
        <div class="flex-col items-center text-center">
            <h1 class="text-gray-700 text-6xl uppercase">error</h1>
            <a
                href="https://cursos.livingroomcollege.org"
                class="mt-5 text-xl text-black hover:underline"
            >
                Volver a la página de Inicio
            </a>
        </div>
    </div>
</template>
<script>
import PxHeader from '../components/PxHeader';

export default {
    components: { PxHeader },
};
</script>
