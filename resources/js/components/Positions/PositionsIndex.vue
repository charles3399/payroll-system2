<template>
    <h1 class="text-2xl tracking-wide text-center">Positions</h1>
    <div class="p-2 mx-5 my-2">
        <router-link :to="{ name: 'positions.create' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Position</router-link>
        <div class="bg-slate-700 rounded-lg">
            <table class="table-auto my-2 text-center">
                <thead>
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Position</th>
                        <th class="px-6 py-3">Basic pay (per hour)</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="position in positions" :key="position.id">
                        <td class="px-6 py-3">{{ position.id }}</td>
                        <td class="px-6 py-3"><router-link :to="{ name: 'positions.show', params: { id: position.id } }" class="hover:underline">{{ position.position_name }}</router-link></td>
                        <td class="px-6 py-3">{{ position.basic_pay }}</td>
                        <td class="px-6 py-3 flex justify-between">
                            <router-link :to="{ name: 'positions.edit', params: { id: position.id } }" class="px-3 py-1 font-bold tracking-wider text-sm bg-green-600 hover:bg-green-700 transform duration-200 rounded-lg mx-1">Edit</router-link>
                            <button @click="destroyPosition(position.id, position.position_name)" class="px-3 py-1 font-bold tracking-wider text-sm bg-red-600 hover:bg-red-800 transform duration-200 rounded-lg mx-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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