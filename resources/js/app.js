import Vue from 'vue'
import VueMeta from 'vue-meta'
import { InertiaApp } from '@inertiajs/inertia-vue'
import PurgeIconsVue from 'purge-icons-vue'
import mavonEditor from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'
import 'mavon-editor/dist/markdown/github-markdown.min.css'
import 'mavon-editor/dist/highlightjs/styles/atom-one-dark.min.css'

Vue.use(InertiaApp)
Vue.use(VueMeta)
Vue.use(PurgeIconsVue)
Vue.use(mavonEditor)

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
