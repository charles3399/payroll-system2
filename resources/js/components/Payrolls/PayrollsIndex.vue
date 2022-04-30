<template>
    <h1 class="text-2xl tracking-wide text-center">Payrolls</h1>
    <div class="p-2 w-5/6 mx-auto">
        <router-link v-if="employees.length > 0" :to="{ name: 'payrolls.create' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Payroll</router-link>
        <div v-else></div>
        <div class="bg-slate-700 rounded-lg">
            <table class="table-auto my-2 text-center">
                <thead>
                    <tr class="bg-gray-600">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Employee</th>
                        <th class="px-4 py-3">Days Worked</th>
                        <th class="px-4 py-3">Overtime</th>
                        <th class="px-4 py-3">Late</th>
                        <th class="px-4 py-3">Absences</th>
                        <th class="px-4 py-3">Bonuses</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <transition-group name="list">
                        <tr v-for="payroll in payrolls" :key="payroll.id">
                            <td class="px-4 py-3">{{ payroll.id }}</td>
                            <td class="px-4 py-3">
                                <router-link :to="{ name: 'payrolls.show', params: { id: payroll.id } }" class="hover:underline">
                                    {{ payroll.employee_id[0].full_name }}
                                </router-link>
                            </td>
                            <td class="px-4 py-3">{{ payroll.days_worked }}</td>
                            <td class="px-4 py-3">{{ payroll.overtime }}</td>
                            <td class="px-4 py-3">{{ payroll.late }}</td>
                            <td class="px-4 py-3">{{ payroll.absences }}</td>
                            <td class="px-4 py-3">{{ payroll.bonuses }}</td>
                            <td class="px-4 py-3">{{ payroll.created_at }}</td>
                            <td class="px-4 py-3 flex justify-between">
                                <router-link :to="{ name: 'payrolls.edit', params: {id: payroll.id} }" class="px-3 py-1 font-bold tracking-wider text-sm bg-green-600 hover:bg-green-700 transform duration-200 rounded-lg mx-1">Edit</router-link>
                                <button @click="destroyPayroll(payroll.id, payroll.employee_id[0].full_name)" class="px-3 py-1 font-bold tracking-wider text-sm bg-red-600 hover:bg-red-800 transform duration-200 rounded-lg mx-1">Delete</button>
                            </td>
                        </tr>
                    </transition-group>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import usePayroll from '../../composables/usePayroll'
    import useEmployee from "../../composables/useEmployee"
    import { onMounted } from 'vue';

    export default {
        setup() {
            const { payrolls, allPayrolls, deletePayroll } = usePayroll()
            const { employees, allEmployees } = useEmployee()

            onMounted(allPayrolls)
            onMounted(allEmployees)

            const destroyPayroll = async (id, name) => {
                if(!window.confirm(`Do you want to delete the payroll for ${name}?`)) {
                    return
                }
                await deletePayroll(id)
                await allPayrolls()
            }

            return { payrolls, destroyPayroll, employees }
        }
    }
</script>