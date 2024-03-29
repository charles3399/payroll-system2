<template>
    <h1 class="text-2xl tracking-wide text-center">Positions</h1>
    <div class="p-2 mx-4">
        <div class="flex flex-wrap justify-between mb-2">
            <router-link :to="{ name: 'Create Position' }" class="px-3 py-2 my-2 inline-block bg-cyan-500 hover:bg-cyan-700 transform duration-200 rounded-lg text-sm font-bold tracking-wider text-center">+ New Position</router-link>
            <input v-model="searchStr" type="text" placeholder="Search position..." class="form-input rounded-lg text-black h-11">
        </div>
        <p class="text-center text-xl" v-if="positions.length === 0">No record yet...</p>
        <table v-else class="table-auto my-2 text-center w-full">
            <thead>
                <tr class="bg-gray-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Position</th>
                    <th class="px-6 py-3">Basic pay (per hour)</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <transition-group appear name="fade" tag="tbody">
                <tr v-for="position in positions.data" :key="position.id" class="bg-slate-700">
                    <td class="px-6 py-3">{{ position.id }}</td>
                    <td class="px-6 py-3"><router-link :to="{ name: 'Position Information', params: { id: position.id, title: position.position_name } }" class="hover:underline">{{ position.position_name }}</router-link></td>
                    <td class="px-6 py-3">{{ position.basic_pay }}</td>
                    <td class="px-6 py-3 flex justify-center">
                        <router-link :to="{ name: 'Edit Position', params: { id: position.id, title: position.position_name } }" class="px-3 py-1 font-bold tracking-wider text-sm bg-green-600 hover:bg-green-700 transform duration-200 rounded-lg mx-1">Edit</router-link>
                        <button @click="destroyPosition(position.id, position.position_name)" class="px-3 py-1 font-bold tracking-wider text-sm bg-red-600 hover:bg-red-800 transform duration-200 rounded-lg mx-1">Delete</button>
                    </td>
                </tr>
            </transition-group>
        </table>
        <Pagination :data="positions" @pagination-change-page="paginateData" :limit="2">
            <template #prev-nav>
                <span>&lt;</span>
            </template>
            <template #next-nav>
                <span>&gt;</span>
            </template>
        </Pagination>
    </div>
</template>

<script>
    import usePosition from '../../composables/usePosition'
    import { onMounted, watch } from 'vue';
    import LaravelVuePagination from 'laravel-vue-pagination'

    export default {
        components: {
            'Pagination': LaravelVuePagination
        },
        setup() {
            const {
                deletePosition,
                positions,
                paginateData,
                searchStr
            } = usePosition()

            onMounted(paginateData)

            watch(() => searchStr.value,
                () => {
                    paginateData()
                },
                { deep: true }
            )

            const destroyPosition = async (id, name) => {
                if(!window.confirm(`Do you want to delete the position: ${name}?`)) {
                    return
                }
                await deletePosition(id)
                await paginateData()
            }

            return {
                destroyPosition,
                positions,
                paginateData,
                searchStr
            }
        }
    }
</script>