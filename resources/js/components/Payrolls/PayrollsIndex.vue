<template>
    <h1 class="text-2xl tracking-wide text-center">Payrolls</h1>
    <div class="p-2 mx-4">
        <div class="flex flex-wrap justify-between mb-2">
            <router-link v-if="employeeDropdown.length > 0" :to="{ name: 'Create Payroll' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Payroll</router-link>
            <div v-else></div>
            <input v-model="searchStr" type="text" placeholder="Search payroll..." class="form-input rounded-lg text-black h-11">
        </div>
        <p class="text-center text-xl" v-if="payrolls.length === 0">No record yet...</p>
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
                <tr v-for="payroll in payrolls.data" :key="payroll.id" class="bg-slate-700">
                    <td class="px-4 py-3">{{ payroll.id }}</td>
                    <td class="px-4 py-3">
                        <router-link :to="{ name: 'Payroll Information', params: { id: payroll.id, title: payroll.employee[0].full_name } }" class="hover:underline">
                            {{ payroll.employee[0].full_name }}
                        </router-link>
                    </td>
                    <td class="px-4 py-3">{{ payroll.employee[0].position.position_name }}</td>
                    <td class="px-4 py-3">{{ timeFormat(payroll.created_at) }}</td>
                    <td class="px-4 py-3 flex justify-between">
                        <router-link :to="{ name: 'Edit Payroll', params: {id: payroll.id, title: payroll.employee[0].full_name} }" class="px-3 py-1 font-bold tracking-wider text-sm bg-green-600 hover:bg-green-700 transform duration-200 rounded-lg mx-1">Edit</router-link>
                        <button @click="destroyPayroll(payroll.id, payroll.employee[0].full_name)" class="px-3 py-1 font-bold tracking-wider text-sm bg-red-600 hover:bg-red-800 transform duration-200 rounded-lg mx-1">Delete</button>
                    </td>
                </tr>
            </transition-group>
        </table>
        <Pagination :data="payrolls" @pagination-change-page="paginateData" :limit="2">
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
    import { onMounted, watch } from 'vue';
    import LaravelVuePagination from 'laravel-vue-pagination'

    export default {
        components: {
            'Pagination': LaravelVuePagination
        },
        setup() {
            const {
                dropdownEmployees,
                employeeDropdown
            } = useEmployee()

            const {
                payrolls,
                searchStr,
                paginateData,
                deletePayroll,
                timeFormat,
            } = usePayroll()

            onMounted(paginateData)
            onMounted(dropdownEmployees)

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

            return {
                destroyPayroll,
                employeeDropdown,
                payrolls,
                paginateData,
                searchStr,
                timeFormat,
            }
        }
    }
</script>