<template>
  <div>
    <ul v-if="posts.data.length" class="divide-y -my-6">
      <li v-for="post in posts.data" class="py-6">
        <h2>
          <inertia-link :href="`/posts/${post.id}`" class="text-xl font-medium hover:text-purple-500 transition-colors duration-100">{{ post.title }}</inertia-link>
        </h2>
        <div class="text-gray-500 font-light mt-1">{{ post.description }}</div>
        <div class="flex items-center space-x-4 text-gray-500 text-sm font-light" :class="hideAuthor ? 'mt-1' : 'mt-3'">
          <inertia-link v-if="!hideAuthor" :href="`/user/${post.author.id}`" class="inline-flex items-center hover:text-purple-500 font-normal">
            <img :src="post.author.avatar" class="w-6 h-6 rounded-full">
            <span class="ml-2">{{ post.author.name }}</span>
          </inertia-link>
          <div>
            <icon class="w-4 h-4 text-purple-500" icon="heroicons-outline:clock" />
            {{ post.created_ago }}
          </div>
          <slot name="info-after" :post="post" />
        </div>
      </li>
    </ul>

    <div v-else class="text-center text-gray-400 mt-8 mb-4">{{ empty }}</div>

    <pagination v-if="posts.showPaginator" class="mt-8" :links="posts.links" />
  </div>
</template>

<script>
import Pagination from '@/Components/Pagination'

export default {
  components: {
    Pagination
  },
  props: {
    posts: {
      type: Object,
      required: true
    },
    hideAuthor: {
      type: Boolean,
      default: false
    },
    empty: {
      type: String,
      default: '目前沒有文章'
    }
  }
}
</script>
