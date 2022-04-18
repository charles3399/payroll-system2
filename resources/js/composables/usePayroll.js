import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function usePayroll() {
    const payrolls = ref([])
    const payroll = ref([])
    const errors = ref('')
    const router = useRouter()

    const allPayrolls = async () => {
        let response = await axios.get('/api/payrolls')
        payrolls.value = response.data.data
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
        allPayrolls,
        getPayroll,
        createPayroll,
        updatePayroll,
        deletePayroll
    }
}