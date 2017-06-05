// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import { Option, Checkbox, Select, Message, Dialog, DatePicker } from 'element-ui'
import VueQuillEditor from 'vue-quill-editor'
import router from './router'

Vue.config.productionTip = false
Vue.use(DatePicker)
Vue.use(Dialog)
Vue.use(Select)
Vue.use(Option)
Vue.use(Checkbox)
Vue.prototype.$message = Message
Vue.use(VueQuillEditor)

/* eslint-disable no-new */

new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
