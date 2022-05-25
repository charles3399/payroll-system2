<template>
    <h1 class="text-2xl tracking-wide text-center">{{ employee.full_name }}</h1>
        <div class="p-2 mx-4 2xl:mx-64 xl:mx-64 lg:mx-64 my-2">
        <router-link :to="{ name: 'All Employees' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Employees</router-link>
        <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
            <h3 class="my-2 text-xl tracking-wider">ID: {{ employee.id }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Full Name: {{ employee.full_name }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Position: {{ employee.position.position_name }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Gender: {{ employee.gender }}</h3>
            <h3 class="my-2 text-xl tracking-wider">E-mail: {{ employee.email }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Address: {{ employee.address }}</h3>
            <router-link :to="{ name: 'Edit Employee', params: { id: employee.id } }" class="my-2 px-3 py-1 text-sm bg-green-500 hover:bg-green-700 transform duration-200 font-bold tracking-wider rounded-lg">Edit</router-link>
        </div>
    </div>
</template>

<script>
    import useEmployee from "../../composables/useEmployee"
    import { onMounted } from 'vue'

    export default {
         props: {
            id: {
                required: true,
                type: String
            }
        },
        setup(props) {
            const { employee, getEmployee } = useEmployee()

            onMounted(getEmployee(props.id))

            return {
                employee
            }
        }
    }
</script>