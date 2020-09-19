<template>
  <div class="markdown-body" v-html="renderedContent"></div>
</template>

<script>
import MarkdownIt from 'markdown-it'
import insert from 'markdown-it-ins'
import taskLists from 'markdown-it-task-lists'
import hljs from 'highlight.js'

export default {
  props: {
    value: {
      type: String,
      required: true
    }
  },
  computed: {
    renderedContent() {
      const markdown = new MarkdownIt({
        breaks: true,
        linkify: true,
        highlight(code, lang) {
          if (lang && hljs.getLanguage(lang)) {
            try {
              return `<pre class="hljs"><code>${hljs.highlight(lang, code, true).value}</code></pre>`
            } catch (_) {}
          }
          return `<pre class="hljs"><code>${markdown.utils.escapeHtml(code)}</code></pre>`
        }
      })

      markdown
        .use(insert)
        .use(taskLists)

      return markdown.render(this.value)
    }
  }
}
</script>
