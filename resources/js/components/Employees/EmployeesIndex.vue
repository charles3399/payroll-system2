<template>
    <h1 class="text-2xl tracking-wide text-center">Employees</h1>
    <div class="p-2 mx-4">
        <div class="flex flex-wrap justify-between mb-2">
            <router-link :to="{ name: 'employees.create' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Employee</router-link>
            <input v-model="searchStr" type="text" placeholder="Search employee..." class="form-input rounded-lg text-black h-11">
        </div>
        <p class="text-center text-xl" v-if="paginateEmployees.length === 0">No record yet...</p>
        <table v-else class="table-auto my-2 text-center">
            <thead>
                <tr class="bg-gray-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Full Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Address</th>
                    <th class="px-6 py-3">Gender</th>
                    <th class="px-6 py-3">Position</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <transition-group appear tag="tbody" name="fade">
                <tr v-for="employee in paginateEmployees.data" :key="employee.id" class="bg-slate-700">
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
        </table>
        <Pagination :data="paginateEmployees" @pagination-change-page="paginateData" :limit="2">
            <template #prev-nav>
                <span>&lt;</span>
            </template>
            <template #next-nav>
                <span>&gt;</span>
            </template>
        </Pagination>
    </div>
</template>

<script>
    import useEmployee from '../../composables/useEmployee'
    import { ref, onMounted, watch } from 'vue'
    import LaravelVuePagination from 'laravel-vue-pagination'
    import axios from 'axios'

    export default {
        components: {
            'Pagination': LaravelVuePagination
        },
        setup() {
            const { deleteEmployee, errors } = useEmployee()
            const paginateEmployees = ref([])
            const searchStr = ref(null)

            const paginateData = async (page = 1) => {
                await axios.get('/api/employees?page=' + page, {params: {page, searchEmployee: searchStr.value}})
                .then(response => {
                    paginateEmployees.value = response.data
                })
            }

            onMounted(paginateData)

            watch(() => searchStr.value,
                () => {
                    paginateData()
                },
                { deep: true }
            )

            const destroyEmployee = async (id, name) => {
                if(!window.confirm(`Do you want to delete employee: ${name}?`)) {
                    return
                }
                await deleteEmployee(id)
                await paginateData()
            }

            return {
                destroyEmployee,
                paginateData,
                paginateEmployees,
                errors,
                searchStr,
            }
        }
    }
</script>