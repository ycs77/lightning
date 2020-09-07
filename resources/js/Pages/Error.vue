<template>
  <div class="bg-white text-gray-600 h-screen flex justify-center items-center relative">
    <div class="text-center text-5xl font-thin px-4 border-r-2 border-current">
      {{ code }}
    </div>
    <div class="text-center text-lg font-light tracking-wider p-3">
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  metaInfo() {
    return {
      title: this.message
    }
  },
  props: {
    code: Number,
    message: String
  }
}
</script>
