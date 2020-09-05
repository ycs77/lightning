import Vue from 'vue'
import VueMeta from 'vue-meta'
import { InertiaApp } from '@inertiajs/inertia-vue'

Vue.use(InertiaApp)
Vue.use(VueMeta)

const app = document.getElementById('app')
const appName = document.title

new Vue({
  metaInfo: {
    titleTemplate: title => title ? `${title} - ${appName}` : appName
  },
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default)
    }
  })
}).$mount(app)
