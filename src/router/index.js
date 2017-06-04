import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import detail from '@/components/detail'
import admin from '@/components/admin'
import area from '@/components/area'
import addnotice from '@/components/addnotice'
import notice from '@/components/notice'
import announcer from '@/components/announcer'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    { path: '/:name',
      component: admin,
      children: [
        { path: '', component: admin },
        { path: 'area', component: area },
        { path: 'addnotice', component: addnotice },
        { path: 'notice', component: notice },
        { path: 'announcer', component: announcer }
      ]
    },
    {
      path: '/detail/:id',
      component: detail
    }
  ]
})
