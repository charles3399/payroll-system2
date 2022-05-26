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
import PageNotFound from "../404.vue"

const routes = [
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Main
    },
    {
        path: '/employees',
        name: 'All Employees',
        component: EmployeesIndex
    },
    {
        path: '/employees/create',
        name: 'Create Employee',
        component: EmployeesCreate
    },
    {
        path: '/employees/:id/edit/:title',
        name: 'Edit Employee',
        component: EmployeesEdit,
        props: true
    },
    {
        path: '/employees/:id/:title',
        name: 'Employee Information',
        component: EmployeesShow,
        props: true
    },
    {
        path: '/positions',
        name: 'All Positions',
        component: PositionsIndex
    },
    {
        path: '/positions/create',
        name: 'Create Position',
        component: PositionsCreate
    },
    {
        path: '/positions/:id/edit/:title',
        name: 'Edit Position',
        component: PositionsEdit,
        props: true
    },
    {
        path: '/positions/:id/:title',
        name: 'Position Information',
        component: PositionsShow,
        props: true
    },
    {
        path: '/payrolls',
        name: 'All Payrolls',
        component: PayrollsIndex
    },
    {
        path: '/payrolls/create',
        name: 'Create Payroll',
        component: PayrollsCreate
    },
    {
        path: '/payrolls/:id/edit/:title',
        name: 'Edit Payroll',
        component: PayrollsEdit,
        props: true
    },
    {
        path: '/payrolls/:id/:title',
        name: 'Payroll Information',
        component: PayrollsShow,
        props: true
    },
    {
        path: '/:catchAll(.*)',
        name: 'LaraPayroll',
        component: PageNotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    let documentTitle = `${to.name}`
    if(to.params.title) {
        documentTitle += ` - ${to.params.title}`
    }
    document.title = documentTitle
    next()
})

export default router