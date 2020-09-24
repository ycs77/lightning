<template>
  <div class="py-6 md:py-8">
    <div class="card card-main">
      <div class="md:flex">
        <div class="md:w-32">
          <img :src="user.avatar" class="rounded-full w-20 h-20 mx-auto">
        </div>
        <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
          <h1 class="text-3xl font-semibold">{{ user.name }}</h1>
          <div v-if="user.description" class="mt-2 text-gray-600 font-light">{{ user.description }}</div>
          <tabs class="mt-4 justify-center md:justify-start" :active="type">
            <tab name="show" :url="`/user/${user.id}`">
              <icon icon="heroicons-outline:book-open" />文章 {{ user.postsCount }}
            </tab>
            <tab name="likes" :url="`/user/${user.id}/likes`">
              <icon icon="heroicons-outline:heart" />喜歡 {{ user.likesCount }}
            </tab>
          </tabs>
        </div>
      </div>
    </div>

    <div class="card card-main mt-6">
      <post-list :posts="user.posts" />
    </div>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import PostList from '@/Lightning/PostList'
import Tabs from '@/Components/Tabs'
import Tab from '@/Components/Tab'

export default {
  layout: AppLayout,
  metaInfo() {
    return {
      title: this.pageTitle
    }
  },
  components: {
    PostList,
    Tabs,
    Tab
  },
  props: {
    pageTitle: String,
    type: String,
    user: Object
  }
}
</script>
