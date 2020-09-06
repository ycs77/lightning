<template>
  <div>
    <div>{{ code }}</div>
    <div>{{ message }}</div>
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
