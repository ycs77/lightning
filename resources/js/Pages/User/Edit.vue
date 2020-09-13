<template>
  <div class="py-6 md:py-8">
    <form @submit.prevent="submit" class="card card-main">
      <h1 class="text-3xl text-center">帳號設定</h1>
      <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

      <alert v-if="$page.flash.success" class="mt-6">{{ $page.flash.success }}</alert>

      <div class="grid gap-6 mt-6 md:grid-cols-2">
        <text-input v-model="form.name" :error="$page.errors.name" label="姓名" autocomplete="name" />
        <text-input v-model="form.email" :error="$page.errors.email" label="E-mail" autocomplete="email" />
        <textarea-input v-model="form.description" :error="$page.errors.description" class="md:col-span-2" label="個人簡介" />
        <text-input v-model="form.password" :error="$page.errors.password" type="password" label="密碼" />
        <text-input v-model="form.password_confirmation" type="password" label="確認密碼" />
        <file-input v-model="form.avatar" :error="$page.errors.avatar" accept="image/*" label="大頭照" browseText="選擇圖片" />
        <div class="md:col-span-2">
          <loading-button :loading="loading" class="btn btn-purple">更新帳號</loading-button>
        </div>
      </div>
    </form>

    <form @submit.prevent="destroy" class="card card-main mt-6">
      <h1 class="text-3xl text-center">刪除帳號</h1>
      <div class="w-12 mt-1 mx-auto border-b-4 border-red-400"></div>

      <div class="grid gap-6 mt-6 md:grid-cols-2">
        <div class="md:col-span-2">
          <loading-button :loading="destroyLoading" class="btn btn-red">刪除帳號</loading-button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Alert from '@/Components/Alert'
import TextInput from '@/Components/TextInput'
import TextareaInput from '@/Components/TextareaInput'
import FileInput from '@/Components/FileInput'
import LoadingButton from '@/Components/LoadingButton'

export default {
  layout: AppLayout,
  metaInfo: {
    title: '帳號設定'
  },
  components: {
    Alert,
    TextInput,
    TextareaInput,
    FileInput,
    LoadingButton
  },
  props: {
    user: Object
  },
  data() {
    return {
      form: {
        name: this.user.name,
        email: this.user.email,
        description: this.user.description,
        password: '',
        password_confirmation: '',
        avatar: null
      },
      loading: false,
      destroyLoading: false
    }
  },
  methods: {
    submit() {
      this.loading = true

      const data = new FormData()
      for (const key in this.form) {
        data.append(key, this.form[key] || '')
      }
      data.append('_method', 'put')

      this.$inertia.post('/user', data).then(() => {
        this.loading = false
        if (! Object.keys(this.$page.errors).length) {
          this.form.password = ''
          this.form.password_confirmation = ''
          this.form.avatar = null
        }
      })
    },
    destroy() {
      if (confirm('確定要刪除當前帳號? 所有文章將會被刪除，且此操作不可恢復!')) {
        this.destroyLoading = true
        this.$inertia.delete('/user').then(() => this.destroyLoading = false)
      }
    }
  }
}
</script>
