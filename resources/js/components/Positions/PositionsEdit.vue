<template>
    <div>
        <h1 class="text-2xl tracking-wide text-center">Edit Position</h1>
        <div class="p-2 mx-4 2xl:mx-64 xl:mx-64 lg:mx-64 my-2">
            <router-link :to="{ name: 'All Positions' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Positions</router-link>
            <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
                <div v-if="errors" class="p-3 my-2">
                    <div v-for="(value, key) in errors" :key="key" class="bg-red-400 p-2 mb-2 font-bold rounded-lg">
                        <p v-for="error in value" :key="error" class="text-sm">
                            {{ error }}
                        </p>
                    </div>
                </div>
                <form @submit.prevent="savePosition">
                    <div class="p-5">
                        <label for="position_name" class="font-bold tracking-wider">Position Name</label>
                        <input type="text" name="position_name" id="position_name" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="position.position_name">
                    </div>
                    <div class="p-5">
                        <label for="basic_pay" class="font-bold tracking-wider">Basic Pay (per hour)</label>
                        <input type="number" name="basic_pay" id="basic_pay" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="position.basic_pay">
                    </div>
                    <div class="p-5">
                        <button type="submit" class="px-5 py-1 text-sm mx-2 bg-green-500 font-bold tracking-wider rounded-lg hover:bg-green-700 transform duration-200">Update</button>
                        <router-link :to="{ name: 'All Positions' }" class="px-5 py-1 mx-2 bg-slate-600 hover:bg-slate-800 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">Cancel</router-link>
                    </div>
                </form>
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
            const { errors, position, getPosition, updatePosition } = usePosition()

            onMounted(getPosition(props.id))

            const savePosition = async () => {
                await updatePosition(props.id)
            }

            return {
                errors,
                position,
                savePosition
            }
        }
    }
</script>