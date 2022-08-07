import {ref} from 'vue'
import axios from 'axios'

export default function usePasser() {

    const passers = ref([])
    const dataDashboard = ref([])
    const searchStr = ref(null)

    const paginatePassers = async (page = 1) => {
        await axios.get('api/allPasser?page=' + page, {params: {page, searchPasser: searchStr.value}})
        .then(response => {
            passers.value = response.data
        })
    }

    const dashboardPassers = async() => {
        let response = await axios.get('api/allPasser')
        dataDashboard.value = response.data.data
    }

    return {
        passers,
        dataDashboard,
        searchStr,
        dashboardPassers,
        paginatePassers
    }
}