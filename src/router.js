import Vue from 'vue';
import Router from 'vue-router';
import ObjectTable from './components/ObjectTable.vue';

Vue.use(Router);

export default new Router({
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: ObjectTable,
    // },
    {
      path: '/list/:id/',
      name: 'ObjectTable',
      components: {
        default: ObjectTable,
      },
      props: {
        default: true,
      },
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue'),
    },
  ],
});
