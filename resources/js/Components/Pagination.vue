<template>
  <div class="font-medium">
    <div class="flex justify-between md:hidden">
      <template v-for="(link, key) in simpleLinks">
        <div v-if="link.url === null" :key="link.label" class="pagination-item pagination-disabled">{{ link.label }}</div>
        <inertia-link v-else :key="link.label" class="pagination-item pagination-link" :href="link.url">{{ link.label }}</inertia-link>
      </template>
    </div>
    <div class="hidden md:flex md:flex-wrap">
      <template v-for="link in links">
        <div v-if="link.active" :key="link.label" class="pagination-item pagination-active mr-2 mt-2">{{ link.label }}</div>
        <div v-else-if="link.url === null" :key="link.label" class="pagination-item pagination-disabled mr-2 mt-2">{{ link.label }}</div>
        <inertia-link v-else :key="link.label" class="pagination-item pagination-link mr-2 mt-2" :href="link.url">{{ link.label }}</inertia-link>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    links: Array
  },
  computed: {
    simpleLinks() {
      return [
        this.links.slice(0).shift(),
        this.links.slice(-1).pop()
      ]
    }
  }
}
</script>
