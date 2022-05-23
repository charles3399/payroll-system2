<template>
    <h1 class="text-2xl tracking-wide text-center">Payrolls</h1>
    <div class="p-2 mx-4">
        <div class="flex flex-wrap justify-between mb-2">
            <router-link v-if="employees.length > 0" :to="{ name: 'payrolls.create' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Payroll</router-link>
            <div v-else></div>
            <input v-model="searchStr" type="text" placeholder="Search payroll..." class="form-input rounded-lg text-black h-11">
        </div>
        <p class="text-center text-xl" v-if="paginatePayrolls.length === 0">No record yet...</p>
        <table v-else class="table-auto my-2 text-center w-full">
            <thead>
                <tr class="bg-gray-600">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Employee</th>
                    <th class="px-4 py-3">Position</th>
                    <th class="px-4 py-3">Created At</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <transition-group appear name="fade" tag="tbody">
                <tr v-for="payroll in paginatePayrolls.data" :key="payroll.id" class="bg-slate-700">
                    <td class="px-4 py-3">{{ payroll.id }}</td>
                    <td class="px-4 py-3">
                        <router-link :to="{ name: 'payrolls.show', params: { id: payroll.id } }" class="hover:underline">
                            {{ payroll.employee_id[0].full_name }}
                        </router-link>
                    </td>
                    <td class="px-4 py-3">{{ payroll.employee_id[0].position.position_name }}</td>
                    <td class="px-4 py-3">{{ payroll.created_at }}</td>
                    <td class="px-4 py-3 flex justify-between">
                        <router-link :to="{ name: 'payrolls.edit', params: {id: payroll.id} }" class="px-3 py-1 font-bold tracking-wider text-sm bg-green-600 hover:bg-green-700 transform duration-200 rounded-lg mx-1">Edit</router-link>
                        <button @click="destroyPayroll(payroll.id, payroll.employee_id[0].full_name)" class="px-3 py-1 font-bold tracking-wider text-sm bg-red-600 hover:bg-red-800 transform duration-200 rounded-lg mx-1">Delete</button>
                    </td>
                </tr>
            </transition-group>
        </table>
        <Pagination :data="paginatePayrolls" @pagination-change-page="paginateData" :limit="2">
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
    import usePayroll from '../../composables/usePayroll'
    import useEmployee from "../../composables/useEmployee"
    import { ref, onMounted, watch } from 'vue';
    import LaravelVuePagination from 'laravel-vue-pagination'
    import axios from 'axios';

    export default {
        components: {
            'Pagination': LaravelVuePagination
        },
        setup() {
            const { deletePayroll } = usePayroll()
            const { employees, allEmployees } = useEmployee()
            const paginatePayrolls = ref([])
            const searchStr = ref(null)

            const paginateData = async (page = 1) => {
                let response = await axios.get('/api/payrolls?page=' + page, {params: {page, searchPayroll: searchStr.value}})
                .then(response => {
                    paginatePayrolls.value = response.data
                })
            }

            onMounted(paginateData)
            onMounted(allEmployees)

            watch(() => searchStr.value,
                () => {
                    paginateData()
                },
                { deep: true }
            )

            const destroyPayroll = async (id, name) => {
                if(!window.confirm(`Do you want to delete the payroll for ${name}?`)) {
                    return
                }
                await deletePayroll(id)
                await paginateData()
            }

            return { destroyPayroll, employees, paginatePayrolls, paginateData, searchStr }
        }
    }
</script>