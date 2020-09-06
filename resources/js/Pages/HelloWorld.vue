<template>
  <div>
    <div>
      <inertia-link href="/">Hello world</inertia-link>
      <inertia-link href="/about">About</inertia-link>
    </div>
    <h1>Hello {{ name }}</h1>
  </div>
</template>

<script>
export default {
  metaInfo: {
    title: 'Hello world'
  },
  props: {
    name: String
  }
}
</script>
