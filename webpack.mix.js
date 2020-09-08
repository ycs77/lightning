const mix = require('laravel-mix')
const PurgeIconsPlugin = require('purge-icons-webpack-plugin').default

mix
  .js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('autoprefixer')
  ])
  .webpackConfig({
    output: {
      chunkFilename: 'js/[name].js?id=[chunkhash]'
    },
    resolve: {
      alias: {
        vue$: 'vue/dist/vue.runtime.esm.js',
        '@': path.resolve('resources/js')
      }
    },
    plugins: [
      new PurgeIconsPlugin()
    ]
  })
  .sourceMaps()
  .version()
