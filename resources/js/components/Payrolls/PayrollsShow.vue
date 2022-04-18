<template>
    <h1 class="text-2xl tracking-wide text-center">Payroll for: {{ payroll.employee_id[0].full_name }}</h1>
    <div class="p-2 mx-5 my-2">
        <router-link :to="{ name: 'payrolls.index' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Payrolls</router-link>
        <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
            <h3 class="my-2 text-xl tracking-wider">ID: {{ payroll.id }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Employee: {{ payroll.employee_id[0].full_name }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Days Worked: {{ payroll.days_worked }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Overtime: {{ payroll.overtime }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Lates: {{ payroll.late }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Absences: {{ payroll.absences }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Bonuses: {{ payroll.bonuses }}</h3>
            <router-link :to="{ name: 'payrolls.edit', params: { id: payroll.id } }" class="my-2 px-3 py-1 text-sm bg-green-500 hover:bg-green-700 transform duration-200 font-bold tracking-wider rounded-lg">Edit</router-link>
        </div>
    </div>
</template>

<script>
    import usePayroll from "../../composables/usePayroll"
    import { onMounted } from 'vue'

    export default {
         props: {
            id: {
                required: true,
                type: String
            }
        },
        setup(props) {
            const { payroll, getPayroll } = usePayroll()

            onMounted(getPayroll(props.id))

            return {
                payroll
            }
        }
    }
</script>