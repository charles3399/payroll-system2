import { createRouter, createWebHistory } from "vue-router";

import Main from '../Main.vue'
import EmployeesIndex from '../components/Employees/EmployeesIndex.vue'
import EmployeesCreate from '../components/Employees/EmployeesCreate.vue'
import EmployeesEdit from '../components/Employees/EmployeesEdit.vue'
import EmployeesShow from '../components/Employees/EmployeesShow.vue'
import PositionsIndex from '../components/Positions/PositionsIndex.vue'
import PositionsCreate from "../components/Positions/PositionsCreate.vue"
import PositionsEdit from "../components/Positions/PositionsEdit.vue"
import PositionsShow from "../components/Positions/PositionsShow.vue"
import PayrollsIndex from "../components/Payrolls/PayrollsIndex.vue"
import PayrollsCreate from "../components/Payrolls/PayrollsCreate.vue"
import PayrollsEdit from "../components/Payrolls/PayrollsEdit.vue"
import PayrollsShow from "../components/Payrolls/PayrollsShow.vue"

const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Main
    },
    {
        path: '/employees',
        name: 'employees.index',
        component: EmployeesIndex
    },
    {
        path: '/employees/create',
        name: 'employees.create',
        component: EmployeesCreate
    },
    {
        path: '/employees/:id/edit',
        name: 'employees.edit',
        component: EmployeesEdit,
        props: true
    },
    {
        path: '/employees/:id',
        name: 'employees.show',
        component: EmployeesShow,
        props: true
    },
    {
        path: '/positions',
        name: 'positions.index',
        component: PositionsIndex
    },
    {
        path: '/positions/create',
        name: 'positions.create',
        component: PositionsCreate
    },
    {
        path: '/positions/:id/edit',
        name: 'positions.edit',
        component: PositionsEdit,
        props: true
    },
    {
        path: '/positions/:id',
        name: 'positions.show',
        component: PositionsShow,
        props: true
    },
    {
        path: '/payrolls',
        name: 'payrolls.index',
        component: PayrollsIndex
    },
    {
        path: '/payrolls/create',
        name: 'payrolls.create',
        component: PayrollsCreate
    },
    {
        path: '/payrolls/:id/edit',
        name: 'payrolls.edit',
        component: PayrollsEdit,
        props: true
    },
    {
        path: '/payrolls/:id',
        name: 'payrolls.show',
        component: PayrollsShow,
        props: true
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})