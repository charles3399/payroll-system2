<template>
    <div>
        <h1 class="text-2xl tracking-wide text-center">{{ position.position_name }}</h1>
        <div class="p-2 mx-4 2xl:mx-64 xl:mx-64 lg:mx-64 my-2">
            <router-link :to="{ name: 'All Positions' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Positions</router-link>
            <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
                <h3 class="my-2 text-xl tracking-wider">Position: {{ position.position_name }}</h3>
                <h3 class="my-2 text-xl tracking-wider">Basic Pay: {{ position.basic_pay }}</h3>
                <router-link :to="{ name: 'Edit Position', params: { id: position.id } }" class="my-2 px-3 py-1 text-sm bg-green-500 hover:bg-green-700 transform duration-200 font-bold tracking-wider rounded-lg">Edit</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import usePosition from "../../composables/usePosition"
    import { onMounted } from 'vue'

    export default {
        props: {
            id: {
                required: true,
                type: String
            }
        },
        setup(props) {
            const { position, getPosition } = usePosition()

            onMounted(getPosition(props.id))

            return {
                position
            }
        }
    }
</script>