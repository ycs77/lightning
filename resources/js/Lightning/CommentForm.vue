<template>
  <form @submit.prevent="submit">
    <markdown-input
      v-model="form.content"
      :placeholder="enabled ? '請輸入留言...' : '登入後即可留言...'"
      :editable="enabled"
      short
      :toolbars-flag="enabled"
      :error="$page.errors.content"
    />
    <div class="text-right mt-4">
      <loading-button v-if="enabled" :loading="loading" class="btn btn-purple">留言</loading-button>
      <inertia-link v-else href="/login" class="btn btn-purple-light">
        登入即可留言
        <icon class="ml-1" icon="heroicons-outline:arrow-right" />
      </inertia-link>
    </div>
  </form>
</template>

<script>
import MarkdownInput from '@/Components/MarkdownInput'
import LoadingButton from '@/Components/LoadingButton'

export default {
  components: {
    MarkdownInput,
    LoadingButton
  },
  props: {
    post: Object,
    enabled: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      form: {
        content: ''
      },
      loading: false
    }
  },
  methods: {
    submit() {
      this.$inertia.post(`/posts/${this.post.id}/comments`, this.form, {
        preserveScroll: true,
        only: ['comments', 'errors'],
        onStart: () => this.loading = true,
        onFinish: () => this.loading = false,
        onSuccess: () => {
          if (! Object.keys(this.$page.errors).length) {
            this.form.content = ''
          }
        }
      })
    }
  }
}
</script>
