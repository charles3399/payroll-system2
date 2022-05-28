import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function usePosition() {
    const positions = ref([])
    const position = ref([])
    const positionDropdown = ref([])
    const errors = ref('')
    const router = useRouter()
    const searchStr = ref(null)

    const paginateData = async (page = 1) => {
        await axios.get('/api/positions?page=' + page, {params: {page, searchPosition: searchStr.value}})
        .then(response => {
            positions.value = response.data
        })
    }

    const getPosition = async (id) => {
        let response = await axios.get(`/api/positions/${id}`)
        position.value = response.data.data
    }

    const dropdownPositions = async () => {
        let response = await axios.get('/api/allPosition')
        positionDropdown.value = response.data.data
    }

    const createPosition = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/positions', data)
            await router.push({name: 'All Positions'})
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updatePosition = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/positions/${id}`, position.value)
            await router.push({name: 'All Positions'})
        } catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const deletePosition = async (id) => {
        await axios.delete(`/api/positions/${id}`)
    }

    return {
        positions,
        position,
        errors,
        positionDropdown,
        searchStr,
        paginateData,
        dropdownPositions,
        getPosition,
        createPosition,
        updatePosition,
        deletePosition
    }
}