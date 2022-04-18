<template>
    <h1 class="text-2xl tracking-wide text-center">Edit Payroll</h1>
    <div class="p-2 mx-5">
        <router-link :to="{ name: 'payrolls.index' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Payrolls</router-link>
        <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
            <div v-if="errors" class="p-3 my-2">
                <div v-for="(value, key) in errors" :key="key" class="bg-red-400 p-2 mb-2 font-bold rounded-lg">
                    <p v-for="error in value" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>
            <form @submit.prevent="savePayroll">
                <div class="p-5">
                    <label for="employee_id" class="font-bold tracking-wider block mb-2">Employee</label>
                    <select name="employee_id" id="employee_id" v-model="payroll.employee_id" class="form-select rounded-lg py-1 text-black font-bold tracking-wider">
                        <option class="font-bold tracking-wider" v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.full_name }}</option>
                    </select>
                </div>
                <div class="p-5">
                    <label for="days_worked" class="font-bold tracking-wider">Days Worked</label>
                    <input type="number" name="days_worked" id="days_worked" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="payroll.days_worked">
                </div>
                <div class="p-5">
                    <label for="overtime" class="font-bold tracking-wider">Overtime (hours)</label>
                    <input type="number" name="overtime" id="overtime" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="payroll.overtime">
                </div>
                <div class="p-5">
                    <label for="late" class="font-bold tracking-wider">Late (mins)</label>
                    <input type="number" name="late" id="late" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="payroll.late">
                </div>
                <div class="p-5">
                    <label for="absences" class="font-bold tracking-wider">Absences (days)</label>
                    <input type="number" name="absences" id="absences" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="payroll.absences">
                </div>
                <div class="p-5">
                    <label for="bonuses" class="font-bold tracking-wider">Bonuses (leave 0 or blank if none)</label>
                    <input type="number" name="bonuses" id="bonuses" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="payroll.bonuses">
                </div>
                <div class="p-5">
                    <button type="submit" class="px-5 py-1 text-sm mx-2 bg-green-500 font-bold tracking-wider rounded-lg hover:bg-green-700 transform duration-200">Update</button>
                    <router-link :to="{ name: 'payrolls.index' }" class="px-5 py-1 mx-2 bg-slate-600 hover:bg-slate-800 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import useEmployee from "../../composables/useEmployee"
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
            const { errors, payroll, getPayroll, updatePayroll } = usePayroll()
            const { employees, allEmployees } = useEmployee()

            onMounted(getPayroll(props.id))
            onMounted(allEmployees())

            const savePayroll = async () => {
                await updatePayroll(props.id)
            }

            return {
                errors,
                payroll,
                employees,
                savePayroll
            }
        }
    }
</script>