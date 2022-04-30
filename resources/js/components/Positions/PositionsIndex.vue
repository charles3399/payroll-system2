<template>
    <h1 class="text-2xl tracking-wide text-center">Positions</h1>
    <div class="p-2 mx-4 2xl:mx-64 xl:mx-64 lg:mx-64">
        <router-link :to="{ name: 'positions.create' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Position</router-link>
        <table class="table-auto my-2 text-center w-full">
            <thead>
                <tr class="bg-gray-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Position</th>
                    <th class="px-6 py-3">Basic pay (per hour)</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
            <transition-group name="fade">
                <tr v-for="position in positions" :key="position.id" class="bg-slate-700">
                    <td class="px-6 py-3">{{ position.id }}</td>
                    <td class="px-6 py-3"><router-link :to="{ name: 'positions.show', params: { id: position.id } }" class="hover:underline">{{ position.position_name }}</router-link></td>
                    <td class="px-6 py-3">{{ position.basic_pay }}</td>
                    <td class="px-6 py-3 flex justify-center">
                        <router-link :to="{ name: 'positions.edit', params: { id: position.id } }" class="px-3 py-1 font-bold tracking-wider text-sm bg-green-600 hover:bg-green-700 transform duration-200 rounded-lg mx-1">Edit</router-link>
                        <button @click="destroyPosition(position.id, position.position_name)" class="px-3 py-1 font-bold tracking-wider text-sm bg-red-600 hover:bg-red-800 transform duration-200 rounded-lg mx-1">Delete</button>
                    </td>
                </tr>
            </transition-group>
            </tbody>
        </table>
    </div>
</template>

<script>
    import usePosition from '../../composables/usePosition'
    import { onMounted } from 'vue';

    export default {
        setup() {
            const { positions, allPositions, deletePosition } = usePosition()

            onMounted(allPositions)

            const destroyPosition = async (id, name) => {
                if(!window.confirm(`Do you want to delete the position: ${name}?`)) {
                    return
                }
                await deletePosition(id)
                await allPositions()
            }

            return { positions, destroyPosition }
        }
    }
</script>