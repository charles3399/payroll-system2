import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function usePosition() {
    const positions = ref([])
    const position = ref([])
    const errors = ref('')
    const router = useRouter()

    const allPositions = async () => {
        let response = await axios.get('/api/positions')
        positions.value = response.data.data
    }

    const getPosition = async (id) => {
        let response = await axios.get(`/api/positions/${id}`)
        position.value = response.data.data
    }

    const createPosition = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/positions', data)
            await router.push({name: 'positions.index'})
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
            await router.push({name: 'positions.index'})
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
        allPositions,
        getPosition,
        createPosition,
        updatePosition,
        deletePosition
    }
}