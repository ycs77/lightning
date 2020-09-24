<template>
  <div class="py-6 md:py-8">
    <alert v-if="$page.flash.success" class="shadow mb-6">{{ $page.flash.success }}</alert>

    <div class="grid gap-6 xl:grid-cols-4">
      <div class="card p-6 md:p-8 min-w-0 xl:col-span-3">
        <h1 class="text-3xl font-semibold leading-snug">{{ post.title }}</h1>
        <div class="flex flex-wrap space-x-4 mt-2 text-sm">
          <div>
            <icon class="text-purple-500" icon="heroicons-outline:clock" />
            <span class="text-gray-500">{{ post.created_at }}</span>
          </div>
          <div>
            <icon class="text-purple-500" icon="heroicons-outline:eye" />
            <span class="text-gray-500">{{ post.visits }}</span>
          </div>
          <div v-if="!post.published">
            <span class="px-2 py-1 bg-green-100 text-green-700">草稿</span>
          </div>
          <inertia-link v-if="post.can.update" :href="`/posts/${post.id}/edit`" class="link">
            <icon icon="heroicons-outline:pencil" />
            編輯
          </inertia-link>
          <a v-if="post.can.delete" :href="`/posts/${post.id}`" class="link" @click.prevent="destroy(post)">
            <icon icon="heroicons-outline:trash" />
            刪除
          </a>
        </div>

        <markdown class="mt-6" :value="post.content" />

        <div class="flex flex-wrap space-x-2 md:space-x-3 mt-6 font-light">
          <inertia-link
            :href="`/posts/${post.id}/like`"
            method="post"
            class="btn btn-purple-light text-sm px-3 py-1 mb-2"
          >
            <icon class="mr-1 text-purple-500" :icon="!post.is_liked
              ? 'heroicons-outline:heart'
              : 'heroicons-solid:heart'"
            />喜歡 | {{ post.likes }}
          </inertia-link>
          <inertia-link v-if="post.can.update"
            :href="`/posts/${post.id}/edit`"
            class="btn btn-blue-light text-sm px-3 py-1 mb-2"
          >
            <icon class="mr-1" icon="heroicons-outline:pencil" />
            編輯
          </inertia-link>
          <a v-if="post.can.delete"
            :href="`/posts/${post.id}`"
            class="btn btn-red-light text-sm px-3 py-1 mb-2"
            @click.prevent="destroy(post)"
          >
            <icon class="mr-1" icon="heroicons-outline:trash" />
            刪除
          </a>
        </div>
        <div v-if="$page.errors.like" class="form-error">{{ $page.errors.like }}</div>
      </div>

      <div>
        <div class="card p-6 md:p-8 sticky top-8">
          <inertia-link :href="`/user/${post.author.id}`">
            <img :src="post.author.avatar" class="rounded-full w-20 h-20 mx-auto">
          </inertia-link>
          <div class="mt-4 text-center">
            <div class="text-2xl font-semibold">
              <inertia-link :href="`/user/${post.author.id}`" class="hover:text-purple-500">
                {{ post.author.name }}
              </inertia-link>
            </div>
            <div v-if="post.author.description" class="mt-2 text-gray-600 font-light">
              {{ post.author.description }}
            </div>
            <div class="flex justify-center items-center space-x-6 mt-3">
              <inertia-link :href="`/user/${post.author.id}`" class="link font-light">
                <icon icon="heroicons-outline:book-open" />
                文章 {{ post.author.postsCount }}
              </inertia-link>
              <inertia-link :href="`/user/${post.author.id}/likes`" class="link font-light">
                <icon icon="heroicons-outline:heart" />
                喜歡 {{ post.author.likesCount }}
              </inertia-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Alert from '@/Components/Alert'
import Markdown from '@/Components/Markdown'

export default {
  layout: AppLayout,
  metaInfo() {
    this.addMeta('description', this.post.description)
    this.addMetaWithProperty('og:type', 'website')
    this.addMetaWithProperty('og:title', this.post.title)
    this.addMetaWithProperty('og:description', this.post.description)
    this.addMetaWithProperty('og:image', this.post.thumbnail)
    this.addMetaWithProperty('og:url', location.href)
    this.addMeta('twitter:title', this.post.title)
    this.addMeta('twitter:description', this.post.description)
    this.addMeta('twitter:url', location.href)
    this.addMeta('twitter:card', 'summary_large_image')
    this.addMeta('twitter:image', this.post.thumbnail)

    return {
      title: this.post.title,
      meta: this.meta
    }
  },
  components: {
    Alert,
    Markdown
  },
  props: {
    post: Object
  },
  data() {
    return {
      meta: []
    }
  },
  methods: {
    addMeta(name, content) {
      if (content) this.meta.push({ name, content })
    },
    addMetaWithProperty(property, content) {
      if (content) this.meta.push({ property, content })
    },
    destroy(post) {
      if (confirm('確定要刪除此文章? 刪除後即無法回復!')) {
        this.$inertia.delete(`/posts/${post.id}`)
      }
    }
  }
}
</script>
