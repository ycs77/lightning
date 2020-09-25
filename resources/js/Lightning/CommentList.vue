<template>
  <ul class="divide-y">
    <li class="flex py-6" v-for="comment in comments">
      <div>
        <inertia-link :href="`/user/${comment.commenter.id}`" class="inline-block">
          <img :src="comment.commenter.avatar" class="rounded-full w-8 h-8">
        </inertia-link>
      </div>

      <div class="flex-1 ml-3 md:ml-4 min-w-0">
        <inertia-link :href="`/user/${comment.commenter.id}`" class="font-medium hover:text-purple-500">
          {{ comment.commenter.name }}
        </inertia-link>

        <div class="flex space-x-4 mt-1 text-sm text-gray-500">
          <div>
            <icon class="w-4 h-4 text-purple-500" icon="heroicons-outline:clock" />
            {{ comment.created_at }}
          </div>
          <a v-if="comment.can.delete"
            :href="`/comments/${comment.id}`"
            class="link inline-flex items-center"
            @click.prevent="destroy(comment)"
          >
            <icon icon="heroicons-outline:trash" />
            刪除
          </a>
        </div>

        <markdown class="mt-3" :value="comment.content" />
      </div>
    </li>
  </ul>
</template>

<script>
import Markdown from '@/Components/Markdown'

export default {
  components: {
    Markdown
  },
  props: {
    comments: Array
  },
  methods: {
    destroy(comment) {
      if (confirm('確定要刪除該留言?')) {
        this.$inertia.delete(`/comments/${comment.id}`, {
          preserveScroll: true
        })
      }
    }
  }
}
</script>
