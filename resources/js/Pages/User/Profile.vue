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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
  layout: AppLayout,
  metaInfo() {
    return {
      title: `用戶 ${this.user.name}`
    }
  },
  props: {
    user: Object
  }
}
</script>
