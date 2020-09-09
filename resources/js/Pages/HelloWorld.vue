<template>
  <div class="container py-8">
    <div class="space-x-3 pb-2 border-b border-purple-200">
      <inertia-link href="/" class="link">Hello world</inertia-link>
      <inertia-link href="/about" class="link">About</inertia-link>
    </div>
    <h1 class="text-2xl mt-2">
      Hello {{ name }}
      <icon class="text-purple-600 mr-1" icon="heroicons-outline:music-note" />
    </h1>
  </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
  layout: AppLayout,
  metaInfo: {
    title: 'Hello world'
  },
  props: {
    name: String
  }
}
</script>
