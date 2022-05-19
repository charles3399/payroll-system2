import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function usePayroll() {
    const payrolls = ref([])
    const payroll = ref([])
    const payrollDropdown = ref([])
    const errors = ref('')
    const router = useRouter()

    const payrollCompute = (basic_pay, days_worked, overtime, bonuses, late, absences) => {
        //Earnings
        let hourly = basic_pay
        let per_day = hourly * 8
        let monthly = per_day * days_worked
        let overtime_final = ((hourly * 0.5) + hourly) * overtime
        let gross_income = monthly + overtime_final + bonuses

        //Deductions
        let late_per_pay = hourly / 60
        let late_overall = Math.round(late_per_pay * late)
        let absent_overall = Math.round(hourly * 8 * absences)
        let sss = Math.round(monthly * 0.0447)
        let hdmf = Math.round(monthly * 0.02)
        let philhealth = Math.round(monthly * 0.04)

        //Net Pay
        let total_deductions = Math.round(sss + hdmf + philhealth + late_overall + absent_overall)
        let net_pay = Math.round(gross_income - total_deductions)

        return { monthly, overtime_final, bonuses, gross_income, sss, hdmf, philhealth, late_overall, absent_overall, total_deductions, net_pay }
    }

    const allPayrolls = async () => {
        let response = await axios.get('/api/payrolls')
        payrolls.value = response.data.data
    }

    const dropdownPayrolls = async () => {
        let response = await axios.get('/api/allPayroll')
        payrollDropdown.value = response.data.data
    }

    const getPayroll = async (id) => {
        let response = await axios.get(`/api/payrolls/${id}`)
        payroll.value = response.data.data
    }

    const createPayroll = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/payrolls', data)
            await router.push({name: 'payrolls.index'})
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updatePayroll = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/payrolls/${id}`, payroll.value)
            await router.push({name: 'payrolls.index'})
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const deletePayroll = async (id) => {
        await axios.delete(`/api/payrolls/${id}`)
    }

    return {
        payrolls,
        payroll,
        errors,
        router,
        payrollDropdown,
        dropdownPayrolls,
        allPayrolls,
        getPayroll,
        createPayroll,
        updatePayroll,
        deletePayroll,
        payrollCompute,
    }
}