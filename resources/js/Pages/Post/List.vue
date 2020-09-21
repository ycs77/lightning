<template>
  <div class="py-6 md:py-8">
    <alert v-if="$page.flash.success" class="shadow mb-6">{{ $page.flash.success }}</alert>

    <div class="card card-main">
      <div>
        <div class="flex justify-between items-center">
          <h2 class="text-3xl">我的{{ typeText }}</h2>
          <div>
            <inertia-link href="/posts/create" class="link">
              <icon icon="heroicons-outline:pencil" />
              撰寫文章
            </inertia-link>
          </div>
        </div>
        <hr class="mt-4">

        <tabs class="mt-4" :active="type">
          <tab name="published" url="/posts">已發布</tab>
          <tab name="drafts" url="/posts/drafts">草稿</tab>
        </tabs>
      </div>

      <div class="mt-6">
        <post-list :posts="posts" hide-author :empty="`目前沒有${typeText}`" />
      </div>
    </div>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Alert from '@/Components/Alert'
import Tabs from '@/Components/Tabs'
import Tab from '@/Components/Tab'
import PostList from '@/Lightning/PostList'

export default {
  layout: AppLayout,
  metaInfo() {
    return {
      title: `我的${this.typeText}`
    }
  },
  components: {
    Alert,
    Tabs,
    Tab,
    PostList
  },
  props: {
    type: String,
    typeText: String,
    posts: Object
  }
}
</script>
