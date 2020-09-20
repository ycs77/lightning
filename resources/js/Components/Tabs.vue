<template>
  <div class="flex space-x-2">
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    active: String
  }
}
</script>
