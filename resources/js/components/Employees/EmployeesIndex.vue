<template>
    <h1 class="text-2xl tracking-wide text-center">Employees</h1>
    <div class="p-2 mx-5 my-2">
        <router-link :to="{ name: 'employees.create' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Employee</router-link>
        <div class="bg-slate-700 rounded-lg">
            <table class="table-auto my-2 text-center">
                <thead>
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Full Name</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Address</th>
                        <th class="px-6 py-3">Gender</th>
                        <th class="px-6 py-3">Position</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <transition-group name="list">
                        <tr v-for="employee in employees" :key="employee.id">
                            <td class="px-6 py-3">{{ employee.id }}</td>
                            <td class="px-6 py-3"><router-link :to="{ name: 'employees.show', params: { id: employee.id } }" class="hover:underline">{{ employee.full_name }}</router-link></td>
                            <td class="px-6 py-3">{{ employee.email }}</td>
                            <td class="px-6 py-3">{{ employee.address }}</td>
                            <td class="px-6 py-3">{{ employee.gender }}</td>
                            <td class="px-6 py-3">{{ employee.position.position_name }}</td>
                            <td class="px-6 py-3 flex justify-between">
                                <router-link :to="{ name: 'employees.edit', params: { id: employee.id } }" class="px-3 py-1 font-bold tracking-wider text-sm bg-green-600 hover:bg-green-700 transform duration-200 rounded-lg mx-1">Edit</router-link>
                                <button @click="destroyEmployee(employee.id, employee.full_name)" class="px-3 py-1 font-bold tracking-wider text-sm bg-red-600 hover:bg-red-800 transform duration-200 rounded-lg mx-1">Delete</button>
                            </td>
                        </tr>
                    </transition-group>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import useEmployee from '../../composables/useEmployee'
    import { onMounted } from 'vue';

    export default {
        setup() {
            const { employees, allEmployees, deleteEmployee } = useEmployee()

            onMounted(allEmployees)

            const destroyEmployee = async (id, name) => {
                if(!window.confirm(`Do you want to delete employee: ${name}?`)) {
                    return
                }
                await deleteEmployee(id)
                await allEmployees()
            }

            return { employees, destroyEmployee }
        }
    }
</script>