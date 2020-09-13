<template>
  <div>
    <label v-if="label" class="form-label">{{ label }}：</label>
    <div class="form-input p-0" :class="{ error }">
      <input ref="file" type="file" :accept="accept" class="hidden" @change="change">
      <div v-if="!value" class="p-2">
        <button type="button" class="btn-purple-light px-4 py-1 rounded text-xs font-medium select-none transition-colors duration-100" @click="browse">
          {{ browseText }}
        </button>
      </div>
      <div v-else class="flex items-center justify-between p-2">
        <div class="flex-1 pr-1">{{ value.name }} <span class="text-purple-500 text-xs">({{ filesize(value.size) }})</span></div>
        <button type="button" class="btn-purple-light px-4 py-1 rounded text-xs font-medium select-none transition-colors duration-100" @click="remove">
          {{ removeText }}
        </button>
      </div>
    </div>
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
export default {
  props: {
    value: File,
    label: String,
    accept: String,
    browseText: {
      type: String,
      default: '選擇檔案'
    },
    removeText: {
      type: String,
      default: '刪除'
    },
    error: String
  },
  watch: {
    value(value) {
      if (!value) {
        this.$refs.file.value = ''
      }
    }
  },
  methods: {
    filesize(size) {
      var i = Math.floor(Math.log(size) / Math.log(1024))
      return (size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
    },
    browse() {
      this.$refs.file.click()
    },
    change(e) {
      this.$emit('input', e.target.files[0])
    },
    remove() {
      this.$emit('input', null)
    }
  }
}
</script>
