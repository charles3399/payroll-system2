<template>
    <h1 class="text-2xl tracking-wide text-center">Create Payroll</h1>
    <div class="p-2 mx-4 2xl:mx-64 xl:mx-64 lg:mx-64">
        <router-link :to="{ name: 'All Payrolls' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Payrolls</router-link>
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
                    <select name="employee_id" id="employee_id" v-model="form.employee_id" class="form-select rounded-lg py-1 text-black font-bold tracking-wider">
                        <option class="font-bold tracking-wider" v-for="employee in employeeDropdown" :key="employee.id" :value="employee.id">{{ employee.full_name }}</option>
                    </select>
                </div>
                <div class="p-5">
                    <label for="days_worked" class="font-bold tracking-wider">Days Worked</label>
                    <input type="number" name="days_worked" id="days_worked" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.days_worked">
                </div>
                <div class="p-5">
                    <label for="overtime" class="font-bold tracking-wider">Overtime (hours)</label>
                    <input type="number" name="overtime" id="overtime" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.overtime">
                </div>
                <div class="p-5">
                    <label for="late" class="font-bold tracking-wider">Late (mins)</label>
                    <input type="number" name="late" id="late" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.late">
                </div>
                <div class="p-5">
                    <label for="absences" class="font-bold tracking-wider">Absences (days)</label>
                    <input type="number" name="absences" id="absences" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.absences">
                </div>
                <div class="p-5">
                    <label for="bonuses" class="font-bold tracking-wider">Bonuses (leave 0 or blank if none)</label>
                    <input type="number" name="bonuses" id="bonuses" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.bonuses">
                </div>
                <div class="p-5">
                    <button type="submit" class="px-5 py-1 text-sm mx-2 bg-green-500 font-bold tracking-wider rounded-lg hover:bg-green-700 transform duration-200">Create</button>
                    <router-link :to="{ name: 'All Payrolls' }" class="px-5 py-1 mx-2 bg-slate-600 hover:bg-slate-800 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import usePayroll from "../../composables/usePayroll"
    import useEmployee from "../../composables/useEmployee"
    import { reactive, onMounted } from 'vue'

    export default {
        setup() {
            const form = reactive({
                'employee_id': '',
                'days_worked' : '',
                'overtime' : '',
                'late' : '',
                'absences' : '',
                'bonuses' : '',
            })

            const { errors, createPayroll } = usePayroll()
            const { employeeDropdown, dropdownEmployees } = useEmployee()

            onMounted(dropdownEmployees())

            const savePayroll = async () => {
                await createPayroll({...form})
            }

            return {
                form,
                errors,
                employeeDropdown,
                savePayroll
            }
        }
    }
</script>