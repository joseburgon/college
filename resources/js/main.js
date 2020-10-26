import Vue from 'vue'
import router from './router'
import VueFormulate from '@braid/vue-formulate'
import App from './App'
import store from '@/store/index'
import Notifications from 'vue-notification'

require('./bootstrap')

Vue.use(VueFormulate)
Vue.use(Notifications)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount('#app')
