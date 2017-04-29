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

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'AdminHome',
            component: AdminHome
        },
        {
            path: '/test',
            name: 'Test',
            component: Test
        },
        {
            path: '/user',
            name: 'AdminUser',
            component: AdminUser
        },
        {
            path: '/article',
            name: 'AdminArticle',
            component: AdminArticle
        },
        {
            path: '/personalcenter',
            name: 'PersonalCenter',
            component: PersonalCenter
        }
    ]

})
