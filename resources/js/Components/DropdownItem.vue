<template>
  <inertia-link :href="href" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 focus:bg-gray-100" v-on="$listeners">
    <template v-if="icon">
      <icon class="mr-2" :icon="icon" />
      <slot />
    </template>
    <slot v-else />
  </inertia-link>
</template>

<script>
export default {
  props: {
    href: {
      type: String,
      required: true
    },
    icon: String
  }
}
</script>
