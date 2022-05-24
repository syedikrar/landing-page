import Vue from 'vue'
import '@babel/polyfill'
import './Utils/fliter'
import App from './App.vue'
import store from './store'
import Raphael from 'raphael/raphael.min.js'
import './plugins'
import './directives'
import VueConfirmDialog from 'vue-confirm-dialog'

global.Raphael = Raphael

Vue.use({store})
Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })

Vue.use(VueConfirmDialog)
Vue.component('vue-confirm-dialog', VueConfirmDialog.default)



import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init()

createInertiaApp({
  resolve: name => import(`./views/${name}`),
  setup({ el, app, props }) {
    new Vue({
      store,
      render: h => h(app, props),
    }).$mount(el)
  },
})