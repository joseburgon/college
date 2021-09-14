<template>
    <div>
        <h3 class="text-gray-700 text-3xl font-semibold">Exportar</h3>

        <div class="mt-4">
            <h4 class="text-gray-600">Exportar Estudiantes</h4>

            <div class="flex space-x-4">

                <div class="w-1/2 mt-4">
                    <div
                        class="w-full bg-white shadow-md rounded-md overflow-hidden border"
                    >
                        <form>
                            <div
                                class="flex justify-between items-center px-5 py-3 text-gray-700 border-b"
                            >
                                <h3 class="text-sm">Exportar Estudiantes Matriculados</h3>
                            </div>

                            <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
                                <label class="text-xs mr-8">Curso:</label>

                                <div class="inline-block relative">
                                    <select
                                        name="current_course_id"
                                        v-model="current_course_id"
                                        required
                                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    >
                                        <option
                                            v-for="(course, index) in courses"
                                            :key="index"
                                            :value="course.id"
                                        >
                                            {{ course.name + ' - ' + course.tagline }}
                                        </option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                    >
                                        <svg
                                            class="fill-current h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center px-5 py-3">
                                <button
                                    class="px-3 py-1 text-gray-700 text-sm rounded-md bg-gray-200 hover:bg-gray-300 focus:outline-none"
                                >
                                    Cancel
                                </button>
                                <a
                                    v-if="current_course_id"
                                    :href="currentEnrolledExportLink"
                                    target="_blank"
                                    class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none"
                                >
                                    Exportar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="w-1/2 mt-4">
                    <div
                        class="w-full bg-white shadow-md rounded-md overflow-hidden border"
                    >
                        <form>
                            <div
                                class="flex justify-between items-center px-5 py-3 text-gray-700 border-b"
                            >
                                <h3 class="text-sm">Exportar Estudiantes Que Finalizaron</h3>
                            </div>

                            <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
                                <label class="text-xs mr-8">Curso:</label>

                                <div class="inline-block relative">
                                    <select
                                        name="completed_course_id"
                                        v-model="completed_course_id"
                                        required
                                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    >
                                        <option
                                            v-for="(course, index) in courses"
                                            :key="index"
                                            :value="course.id"
                                        >
                                            {{ course.name + ' - ' + course.tagline }}
                                        </option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                    >
                                        <svg
                                            class="fill-current h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center px-5 py-3">
                                <button
                                    class="px-3 py-1 text-gray-700 text-sm rounded-md bg-gray-200 hover:bg-gray-300 focus:outline-none"
                                >
                                    Cancel
                                </button>
                                <a
                                    v-if="completed_course_id"
                                    :href="completedEnrollmentsExportLink"
                                    target="_blank"
                                    class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none"
                                >
                                    Exportar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="flex space-x-4">

                <div class="w-1/2 mt-4">
                    <div
                        class="w-full bg-white shadow-md rounded-md overflow-hidden border"
                    >
                        <form>
                            <div
                                class="flex justify-between items-center px-5 py-3 text-gray-700 border-b"
                            >
                                <h3 class="text-sm">Exportar TODOS los estudiantes</h3>
                            </div>

                            <div class="flex justify-between items-center p-5">
                                <a
                                    :href="allHistoricEnrolledLink"
                                    target="_blank"
                                    class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none"
                                >
                                    Exportar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="w-1/2 mt-4">
                    <div
                        class="w-full bg-white shadow-md rounded-md overflow-hidden border"
                    >
                        <form>
                            <div
                                class="flex justify-between items-center px-5 py-3 text-gray-700 border-b"
                            >
                                <h3 class="text-sm">Exportar Estudiantes NO matriculados</h3>
                            </div>

                            <div class="flex justify-between items-center p-5">
                                <a
                                    :href="notEnrolledExportLink"
                                    target="_blank"
                                    class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none"
                                >
                                    Exportar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import DashboardLayout from '../../layouts/DashboardLayout'

export default {
    name: 'Dashboard',
    components: {},

    data() {
        return {
            current_course_id: '',
            completed_course_id: '',
            courses: {},
            openSidebar: '',
            closeSidebar: '',
            sidebarOpen: '',
            notEnrolledExportLink: '/api/enrollments/not-enrolled',
            allHistoricEnrolledLink: '/api/enrollments/all-historic',
            loading: false,
        }
    },
    computed: {
        currentEnrolledExportLink() {
            return `/api/enrollments/${this.current_course_id}/current`
        },

        completedEnrollmentsExportLink() {
            return `/api/enrollments/${this.completed_course_id}/completed`
        },
    },
    created() {
        this.$emit(`update:layout`, DashboardLayout)
    },
    mounted() {
        this.loading = true

        axios
            .get(`/api/courses`)
            .then((res) => {
                console.log(res.data)
                this.courses = res.data
            })
            .catch((e) => {
                this.$router.push({name: 'error'})
            })
    },
}
</script>
