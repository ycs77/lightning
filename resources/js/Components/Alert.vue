<template>
  <div v-if="type === 'success'" class="alert alert-success">
    <icon class="mr-1" icon="heroicons-outline:check-circle" />
    <slot />
  </div>
  <div v-else-if="type === 'error'" class="alert alert-error">
    <icon class="mr-1" icon="heroicons-outline:x-circle" />
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: 'success'
    }
  }
}
</script>
