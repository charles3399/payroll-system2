<template>
    <h1 class="text-2xl tracking-wide text-center">Payroll for: {{ payroll.employee_id[0].full_name }}</h1>
    <div class="p-2 mx-4 2xl:mx-64 xl:mx-64 lg:mx-64 my-2">
        <router-link :to="{ name: 'payrolls.index' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Payrolls</router-link>
        <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
            <h3 class="my-2 text-xl tracking-wider">ID: {{ payroll.id }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Employee: {{ payroll.employee_id[0].full_name }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Position: {{ payroll.employee_id[0].position.position_name }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Basic pay: {{ payroll.employee_id[0].position.basic_pay }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Days Worked: {{ payroll.days_worked }}</h3>
            <h3 class="my-2 text-xl tracking-wider">Overtime: {{ payroll.overtime }} hr(s)</h3>
            <h3 class="my-2 text-xl tracking-wider">Lates: {{ payroll.late }} min(s)</h3>
            <h3 class="my-2 text-xl tracking-wider">Absences: {{ payroll.absences }} days</h3>
            <h3 class="my-2 text-xl tracking-wider">Bonuses: {{ payroll.bonuses }}</h3>
            <router-link :to="{ name: 'payrolls.edit', params: { id: payroll.id } }" class="my-2 px-3 py-1 text-sm bg-green-500 hover:bg-green-700 transform duration-200 font-bold tracking-wider rounded-lg">Edit</router-link>
        </div>
        <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
            <h2 class="mb-1 text-xl">Payroll breakdown</h2>
            <table class="table-auto text-center mb-3 bg-slate-500 rounded-lg">
                    <thead class="bg-slate-400">
                        <tr>
                            <th class="p-3">Monthly Pay</th>
                            <th class="p-3">Overtime Pay</th>
                            <th class="p-3">Bonus</th>
                            <th class="p-3">Gross Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).monthly) }}</td>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).overtime_final) }}</td>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).bonuses) }}</td>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).gross_income) }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table-auto text-center mb-3 bg-slate-500 rounded-lg">
                    <thead class="bg-slate-400">
                        <tr>
                            <th class="p-3">SSS (Social Security System)</th>
                            <th class="p-3">HDMF (Home Development Mutual Fund)</th>
                            <th class="p-3">PhilHealth</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).sss) }}</td>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).hdmf) }}</td>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).philhealth) }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table-auto text-center mb-3 bg-slate-500 rounded-lg">
                    <thead class="bg-slate-400">
                        <tr>
                            <th class="p-3">Lates</th>
                            <th class="p-3">Absences</th>
                            <th class="p-3">Total deduction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).late_overall) }}</td>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).absent_overall) }}</td>
                            <td class="p-2">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).total_deductions) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="bg-slate-700">
                    <h4 class="text-lg">Total Pay for {{ payroll.employee_id[0].full_name }}: <strong class="font-bold text-2xl">{{ numberWithCommas(payrollCompute(payroll.employee_id[0].position.basic_pay, payroll.days_worked, payroll.overtime, payroll.bonuses, payroll.late, payroll.absences).net_pay) }}</strong></h4>
                    <small class="text-xs">Total pay = gross income - total deduction</small>
                </div>
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
            const { payroll, getPayroll, payrollCompute } = usePayroll()

            const numberWithCommas = (x) => {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }

            onMounted(getPayroll(props.id))

            return {
                payroll,
                payrollCompute,
                numberWithCommas
            }
        }
    }
</script>