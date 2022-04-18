<template>
    <h1 class="text-2xl tracking-wide text-center">Create New Position</h1>
    <div class="p-2 mx-5 my-2">
        <router-link :to="{ name: 'positions.index' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Positions</router-link>
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
                    <input type="text" name="position_name" id="position_name" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.position_name">
                </div>
                <div class="p-5">
                    <label for="basic_pay" class="font-bold tracking-wider">Basic Pay (per hour)</label>
                    <input type="number" name="basic_pay" id="basic_pay" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.basic_pay">
                </div>
                <div class="p-5">
                    <button type="submit" class="px-5 py-1 text-sm mx-2 bg-green-500 font-bold tracking-wider rounded-lg hover:bg-green-700 transform duration-200">Create</button>
                    <router-link :to="{ name: 'positions.index' }" class="px-5 py-1 mx-2 bg-slate-600 hover:bg-slate-800 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import usePosition from "../../composables/usePosition"
    import { reactive } from 'vue'

    export default {
        setup() {
            const form = reactive({
                'position_name': '',
                'basic_pay' : '',
            })

            const { errors, createPosition } = usePosition()

            const savePosition = async () => {
                await createPosition({...form})
            }

            return {
                form,
                errors,
                savePosition
            }
        }
    }
</script>