<template>
  <div class="relative z-50">
    <slot name="button" :open="open" />
    <button v-if="isOpen" @click="close" tabindex="-1" class="fixed z-40 inset-0 h-full w-full cursor-default"></button>
    <transition
      enter-class="opacity-0 scale-90"
      enter-active-class="transition duration-150 ease-out origin-top-right"
      enter-to-class="opacity-1 scale-100"
      leave-class="opacity-1 scale-100"
      leave-active-class="transition duration-150 ease-in origin-top-right"
      leave-to-class="opacity-0 scale-90"
    >
      <div v-if="isOpen" class="absolute z-50 right-0 mt-4 py-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg transform">
        <slot name="menu" :close="close" />
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false
    }
  },
  methods: {
    open() {
      this.isOpen = true
    },
    close() {
      this.isOpen = false
    }
  },
  created() {
    const handleEscape = e => {
      if (['Esc', 'Escape'].includes(e.key)) {
        this.isOpen = false
      }
    }

    document.addEventListener('keydown', handleEscape)
    this.$once('hook:beforeDestroy', () => {
      document.removeEventListener('keydown', handleEscape)
    })
  }
}
</script>
