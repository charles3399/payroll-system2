import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useEmployee() {
    const employees = ref([])
    const employee = ref([])
    const employeeDropdown = ref([])
    const errors = ref('')
    const router = useRouter()
    const searchStr = ref(null)

    const paginateData = async (page = 1) => {
        await axios.get('/api/employees?page=' + page, {params: {page, searchEmployee: searchStr.value}})
        .then(response => {
            employees.value = response.data
        })
    }

    const dropdownEmployees = async () => {
        let response = await axios.get('/api/allEmployee')
        employeeDropdown.value = response.data.data
    }

    const getEmployee = async (id) => {
        let response = await axios.get(`/api/employees/${id}`)
        employee.value = response.data.data
    }

    const createEmployee = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/employees', data)
            await router.push({name: 'All Employees'})
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
            await router.push({name: 'All Employees'})
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const deleteEmployee = async (id) => {
        await axios.delete(`/api/employees/${id}`)
    }

    const setPasser = async (id) => {
        await axios.post('/api/setPasser', {employee_id: id, reason: null})
        .then(function (res){
            console.log(res);
        });
        //await router.push({name: 'All Employees'})
    }

    return {
        employees,
        employee,
        errors,
        router,
        employeeDropdown,
        searchStr,
        paginateData,
        dropdownEmployees,
        getEmployee,
        createEmployee,
        updateEmployee,
        deleteEmployee,
        setPasser
    }
}