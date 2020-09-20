<template>
  <div v-if="name === active" class="tab tab-active">
    <slot />
  </div>
  <inertia-link v-else :href="url" class="tab tab-link">
    <slot />
  </inertia-link>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true
    },
    url: String
  },
  computed: {
    active() {
      return this.$parent.$options._componentTag === 'tabs'
        ? this.$parent.active
        : null
    }
  }
}
</script>
