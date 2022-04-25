<template>
    <div class="p-5 m-5">
        <router-link v-if="positions.length > 0" to="/employees" class="mx-5 p-5 font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-white hover:text-black transform duration-200">Employees&nbsp;{{ employees.length }}</router-link>

        <button @click="verify('employees')" v-else class="mx-5 p-5 font-bold tracking-wide text-2xl border-2 border-white rounded-lg opacity-80 cursor-default">Employees&nbsp;{{ employees.length }}</button>

        <router-link v-if="employees.length > 0" to="/payrolls" class="mx-5 p-5 font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-white hover:text-black transform duration-200">Payrolls&nbsp;{{ payrolls.length }}</router-link>

        <button @click="verify('payrolls')" v-else class="mx-5 p-5 font-bold tracking-wide text-2xl border-2 border-white rounded-lg opacity-80 cursor-default">Payrolls&nbsp;{{ payrolls.length }}</button>

        <router-link to="/positions" class="mx-5 p-5 font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-white hover:text-black transform duration-200">Positions&nbsp;{{ positions.length }}</router-link>
    </div>
</template>

<script>
    import useEmployee from "./composables/useEmployee"
    import usePayroll from "./composables/usePayroll"
    import usePosition from "./composables/usePosition"
    import { onMounted } from "vue"

    export default {
        setup() {
            const { employees, allEmployees } = useEmployee()
            const { positions, allPositions } = usePosition()
            const { payrolls, allPayrolls } = usePayroll()
            
            onMounted(allEmployees())
            onMounted(allPositions())
            onMounted(allPayrolls())

            const verify = (e) => {
                e === 'employees' ? alert('There are no positions, please create a position first before creating an employee') : alert('There are no existing employees, please create an employee first before creating a payroll')
            }

            return {
                employees,
                positions,
                payrolls,
                verify,
            }
        }
    }
</script>
<style>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>