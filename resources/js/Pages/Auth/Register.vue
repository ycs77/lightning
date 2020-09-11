<template>
  <div class="py-6 md:py-8">
    <form @submit.prevent="submit" class="card max-w-sm p-6 md:p-8 mx-auto">
      <h1 class="text-3xl text-center">註冊</h1>
      <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

      <div class="grid gap-6 mt-6">
        <text-input v-model="form.name" :error="$page.errors.name" label="姓名" autocomplete="name" ref="nameInput" />
        <text-input v-model="form.email" :error="$page.errors.email" label="E-mail" autocomplete="email" />
        <text-input v-model="form.password" :error="$page.errors.password" type="password" label="密碼" />
        <text-input v-model="form.password_confirmation" type="password" label="確認密碼" />
        <div>
          <loading-button :loading="loading" class="btn btn-purple">註冊</loading-button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import TextInput from '@/Components/TextInput'
import LoadingButton from '@/Components/LoadingButton'

export default {
  layout: AppLayout,
  metaInfo: {
    title: '註冊'
  },
  components: {
    TextInput,
    LoadingButton
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      loading: false
    }
  },
  methods: {
    submit() {
      this.loading = true
      this.$inertia.post('/register', this.form).then(() => this.loading = false)
    }
  },
  mounted() {
    this.$refs.nameInput.focus()
  }
}
</script>
