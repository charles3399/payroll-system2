import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useEmployee() {
    const employees = ref([])
    const employee = ref([])
    const errors = ref('')
    const router = useRouter()

    const allEmployees = async (page = 1) => {
        let response = await axios.get('/api/employees?page=' + page)
        employees.value = response.data
    }

    const getEmployee = async (id) => {
        let response = await axios.get(`/api/employees/${id}`)
        employee.value = response.data.data
    }

    const createEmployee = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/employees', data)
            await router.push({name: 'employees.index'})
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateEmployee = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/employees/${id}`, employee.value)
            await router.push({name: 'employees.index'})
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const deleteEmployee = async (id) => {
        await axios.delete(`/api/employees/${id}`)
    }

    return {
        employees,
        employee,
        errors,
        router,
        allEmployees,
        getEmployee,
        createEmployee,
        updateEmployee,
        deleteEmployee
    }
}