/**
 * Created by Z on 2017/4/29.
 */
import Vue from 'vue'
import Router from 'vue-router'
import Test from '@/pages/Test'
import AdminHome from '@/pages/AdminHome'
import AdminUser from '@/pages/AdminUser'
import AdminArticle from '@/pages/AdminArticle'
import PersonalCenter from '@/pages/PersonalCenter'
import Login from '@/pages/Login'
import Signup from '@/pages/Signup'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'AdminHome',
            component: AdminHome,
            meta:{
                requireAuth:true
            }
        },
        {
            path: '/test',
            name: 'Test',
            component: Test
        },
        {
            path: '/user',
            name: 'AdminUser',
            component: AdminUser,
            meta:{
                requireAuth:true
            }
        },
        {
            path: '/article',
            name: 'AdminArticle',
            component: AdminArticle,
            meta:{
                requireAuth:true
            }
        },
        {
            path: '/personalcenter',
            name: 'PersonalCenter',
            component: PersonalCenter,
            meta:{
                requireAuth:true
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/Signup',
            name: 'Signup',
            component: Signup
        }
    ]

})
