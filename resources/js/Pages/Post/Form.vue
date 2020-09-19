<template>
  <div class="py-6 md:py-8">
    <form @submit.prevent="submit" class="card card-main">
      <h1 class="text-3xl text-center">{{ pageTitle }}</h1>
      <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

      <div class="grid gap-6 mt-6">
        <text-input v-model="form.title" :error="$page.errors.title" label="標題" ref="titleInput" autocomplete="off" />
        <markdown-input v-model="form.content" :error="$page.errors.content" label="內容" class="min-w-0" />
        <file-input v-model="form.thumbnail" :error="$page.errors.thumbnail" accept="image/*" label="分享預覽圖片" browseText="選擇圖片" />
        <img v-if="post.thumbnail" :src="post.thumbnail" class="max-w-xs rounded shadow">
        <div class="font-light mb-4">
          <label>
            <input type="checkbox" class="form-checkbox" v-model="form.published"> 發布文章
          </label>
        </div>
        <div class="flex items-center space-x-4">
          <loading-button :loading="loading" class="btn btn-purple">{{ btnText }}</loading-button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import TextInput from '@/Components/TextInput'
import MarkdownInput from '@/Components/MarkdownInput'
import FileInput from '@/Components/FileInput'
import LoadingButton from '@/Components/LoadingButton'

export default {
  layout: AppLayout,
  metaInfo() {
    return {
      title: this.pageTitle
    }
  },
  components: {
    TextInput,
    MarkdownInput,
    FileInput,
    LoadingButton
  },
  props: {
    post: Object
  },
  remember: 'form',
  data() {
    return {
      form: {
        title: this.post.title,
        content: this.post.content,
        thumbnail: null,
        published: this.post.published
      },
      loading: false
    }
  },
  computed: {
    pageTitle() {
      return '撰寫文章'
    },
    btnText() {
      return '儲存文章'
    }
  },
  methods: {
    submit() {
      this.loading = true

      const data = new FormData()
      for (const key in this.form) {
        data.append(key, this.form[key] || '')
      }

      return this.$inertia.post('/posts', data).then(() => {
        this.loading = false
        if (! Object.keys(this.$page.errors).length) {
          this.form.thumbnail = null
        }
      })
    }
  },
  mounted() {
    this.$refs.titleInput.focus()
  }
}
</script>
