<template>
<h1 class="text-2xl tracking-wide text-center">Passers</h1>
    <div class="p-2 mx-4">
        <div class="flex flex-wrap justify-between mb-2">
            <input v-model="searchStr" type="text" placeholder="Search passer..." class="form-input rounded-lg text-black h-11">
        </div>
        <p class="text-center text-xl" v-if="passers.length === 0">No record yet...</p>
        <table v-else class="table-auto my-2 text-center">
            <thead>
                <tr class="bg-gray-600">
                    <th class="px-6 py-3">Passer ID</th>
                    <th class="px-6 py-3">Full Name</th>
                    <th class="px-6 py-3">Gender</th>
                    <th class="px-6 py-3">Position</th>
                </tr>
            </thead>
            <transition-group appear tag="tbody" name="fade">
                <tr v-for="passer in passers.data" :key="passer.id" class="bg-slate-700">
                    <td class="px-6 py-3">{{ passer.id }}</td>
                    <td class="px-6 py-3">{{ passer.employee.full_name }}</td>
                    <td class="px-6 py-3">{{ passer.employee.gender }}</td>
                    <td class="px-6 py-3">{{ passer.employee.position.position_name }}</td>
                </tr>
            </transition-group>
        </table>
        <Pagination :data="passers" @pagination-change-page="paginatePassers" :limit="2">
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
    import usePasser from '../../composables/usePasser'
    import { onMounted, watch } from 'vue'
    import LaravelVuePagination from 'laravel-vue-pagination'

    export default {
        components: {
            'Pagination': LaravelVuePagination
        },
        setup() {
            const {
                passers,
                searchStr,
                paginatePassers,
            } = usePasser()

            onMounted(paginatePassers)

            watch(() => searchStr.value,
                () => {
                    paginatePassers()
                },
                { deep: true }
            )

            return {
                passers,
                paginatePassers,
                searchStr,
            }
        }
    }
</script>