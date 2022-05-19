<template>
    <div class="p-5 flex flex-wrap justify-center items-center">
        <router-link v-if="positionDropdown.length > 0" to="/employees" class="m-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-red-400 hover:border-red-400 transform duration-200">Employees <p class="text-md mt-1">{{ employeeDropdown.length }}</p></router-link>

        <button @click="verify('employees')" v-else class="mx-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg opacity-80 cursor-default">Employees</button>

        <router-link v-if="employeeDropdown.length > 0" to="/payrolls" class="m-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-green-400 hover:border-green-400 transform duration-200">Payrolls <p class="text-md mt-1">{{ payrollDropdown.length }}</p></router-link>

        <button @click="verify('payrolls')" v-else class="mx-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg opacity-80 cursor-default">Payrolls</button>

        <router-link to="/positions" class="m-5 p-5 text-center font-bold tracking-wide text-2xl border-2 border-white rounded-lg hover:bg-blue-600 hover:border-blue-600 transform duration-200">Positions <p class="text-md mt-1">{{ positionDropdown.length }}</p></router-link>
    </div>
</template>

<script>
    import useEmployee from "./composables/useEmployee"
    import usePayroll from "./composables/usePayroll"
    import usePosition from "./composables/usePosition"
    import { onMounted } from "vue"

    export default {
        setup() {
            const { employeeDropdown, dropdownEmployees } = useEmployee()
            const { positionDropdown, dropdownPositions } = usePosition()
            const { payrollDropdown, dropdownPayrolls } = usePayroll()
            
            onMounted(dropdownEmployees())
            onMounted(dropdownPositions())
            onMounted(dropdownPayrolls())

            const verify = (e) => {
                e === 'employees' ? alert('There are no positions, please create a position first before creating an employee') : alert('There are no existing employees, please create an employee first before creating a payroll')
            }

            return {
                employeeDropdown,
                positionDropdown,
                payrollDropdown,
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