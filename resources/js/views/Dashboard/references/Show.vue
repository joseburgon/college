<template>
  <div v-if="reference.id">
    <h3 class="text-gray-700 text-3xl font-medium">Referencias</h3>

    <div class="mt-8"></div>

    <div class="font-bold text-gray-700 text-lg">Código</div>
    <p>{{ reference.attributes.code }}</p>

    <div class="font-bold text-gray-700 text-lg mt-8">Estudiante</div>
    <router-link
      :to="{
        name: 'students-edit',
        params: { id: reference.attributes.student.id },
      }"
      class="text-indigo-600 hover:text-indigo-900"
    >
      {{
        reference.attributes.student.name +
        ' ' +
        reference.attributes.student.last_name
      }}
    </router-link>

    <div class="font-bold text-gray-700 text-lg mt-8">Curso</div>
    <p>{{ reference.attributes.course.name }}</p>

    <div class="font-bold text-gray-700 text-lg mt-8">Referencia Creada</div>
    <p>{{ reference.attributes.created_at }}</p>

    <div class="font-bold text-gray-700 text-lg mt-8">Referencia Actualizada</div>
    <p>{{ reference.attributes.updated_at }}</p>
  </div>
</template>

<script>
import User from '@/apis/User'
import References from '@/apis/References'
import DashboardLayout from '@/layouts/DashboardLayout'

export default {
  data() {
    return {
      reference: {},
    }
  },
  created() {
    this.$emit(`update:layout`, DashboardLayout)

    User.auth().then((response) => {
      this.user = response.data
    })
  },
  mounted() {
    this.getreference()
  },
  methods: {
    getreference() {
      const { id } = this.$route.params
      References.getReference(id)
        .then((res) => {
          this.reference = res.data.data
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },
}
</script>
