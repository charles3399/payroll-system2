<template>
    <div class="p-5 flex justify-center items-center">
        <router-link v-if="positions.data.length > 0" to="/employees" class="mx-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-white hover:text-black transform duration-200">Employees</router-link>

        <button @click="verify('employees')" v-else class="mx-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg opacity-80 cursor-default">Employees</button>

        <router-link v-if="employees.data.length > 0" to="/payrolls" class="mx-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-white hover:text-black transform duration-200">Payrolls</router-link>

        <button @click="verify('payrolls')" v-else class="mx-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg opacity-80 cursor-default">Payrolls</button>

        <router-link to="/positions" class="mx-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-white hover:text-black transform duration-200">Positions</router-link>
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
.fade-move,
.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s cubic-bezier(0.55, 0, 0.1, 1);
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scaleY(0.01) translate(30px, 0);
}
.fade-leave-active {
  position: absolute;
}
</style>