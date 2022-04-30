<template>
    <h1 class="text-2xl tracking-wide text-center">Create Employee</h1>
    <div class="p-2 mx-4 2xl:mx-64 xl:mx-64 lg:mx-64">
        <router-link :to="{ name: 'employees.index' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">All Employees</router-link>
        <div class="my-2 px-5 py-3 bg-gray-700 rounded-lg">
            <div v-if="errors" class="p-3 my-2">
                <div v-for="(value, key) in errors" :key="key" class="bg-red-400 p-2 mb-2 font-bold rounded-lg">
                    <p v-for="error in value" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>
            <form @submit.prevent="saveEmployee">
                <div class="p-5">
                    <label for="full_name" class="font-bold tracking-wider">Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.full_name">
                </div>
                <div class="p-5">
                    <label for="email" class="font-bold tracking-wider">E-mail</label>
                    <input type="email" name="email" id="email" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.email">
                </div>
                <div class="p-5">
                    <label for="address" class="font-bold tracking-wider">Address</label>
                    <input type="text" name="address" id="address" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.address">
                </div>
                <div class="p-5">
                    <label for="gender" class="font-bold tracking-wider">Gender</label>
                    <input type="text" name="gender" id="gender" class="form-input block p-1 mb-2 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" v-model="form.gender">
                </div>
                <div class="p-5">
                    <label for="position_id" class="font-bold tracking-wider block mb-2">Position</label>
                    <select name="position_id" id="position_id" v-model="form.position_id" class="form-select rounded-lg py-1 text-black font-bold tracking-wider">
                        <option class="font-bold tracking-wider" v-for="position in positions" :key="position.id" :value="position.id">{{ position.position_name }}</option>
                    </select>
                </div>
                <div class="p-5">
                    <button type="submit" class="px-5 py-1 text-sm mx-2 bg-green-500 font-bold tracking-wider rounded-lg hover:bg-green-700 transform duration-200">Create</button>
                    <router-link :to="{ name: 'employees.index' }" class="px-5 py-1 mx-2 bg-slate-600 hover:bg-slate-800 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import usePosition from "../../composables/usePosition"
    import useEmployee from "../../composables/useEmployee"
    import { reactive, onMounted } from 'vue'

    export default {
        setup() {
            const form = reactive({
                'full_name': '',
                'email' : '',
                'address' : '',
                'gender' : '',
                'position_id' : '',
            })

            const { errors, createEmployee } = useEmployee()
            const { positions, allPositions } = usePosition()

            onMounted(allPositions())

            const saveEmployee = async () => {
                await createEmployee({...form})
            }

            return {
                form,
                errors,
                positions,
                saveEmployee
            }
        }
    }
</script>