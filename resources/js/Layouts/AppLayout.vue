<template>
  <div class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow">
      <div class="container flex items-center justify-between h-16 md:h-20">
        <h1>
          <inertia-link href="/" class="block text-2xl font-light italic md:text-3xl">
            <icon class="text-purple-500 w-6 h-6 md:w-8 md:h-8" icon="heroicons-solid:lightning-bolt" />
            <span>{{ $page.title }}</span>
          </inertia-link>
        </h1>

        <nav>
          <ul class="flex text-sm md:text-base space-x-1 md:space-x-4 items-center">
            <template v-if="!user">
              <li>
                <inertia-link href="/login" class="px-3 py-2 md:px-5 rounded text-gray-400 hover:text-gray-900 transition-colors duration-150">
                  登入
                </inertia-link>
              </li>
              <li>
                <inertia-link href="/register" class="px-3 py-2 md:px-5 rounded bg-purple-500 text-white hover:bg-purple-700 transition-colors duration-150">
                  註冊
                </inertia-link>
              </li>
            </template>
            <template v-else>
              <li>
                <dropdown class="text-base">
                  <template #button="{ open }">
                    <button @click="open" class="relative z-10 block h-10 w-10 rounded-full overflow-hidden border-2 border-transparent focus:outline-none focus:border-purple-500">
                      <img class="h-full w-full object-cover" :src="user.avatar">
                    </button>
                  </template>
                  <template #menu="{ close }">
                    <dropdown-item href="/logout" method="post" icon="heroicons-outline:logout" @click="close">
                      登出
                    </dropdown-item>
                  </template>
                </dropdown>
              </li>
            </template>
          </ul>
        </nav>
      </div>
    </header>

    <div class="container">
      <slot />
    </div>
  </div>
</template>

<script>
import Dropdown from '@/Components/Dropdown'
import DropdownItem from '@/Components/DropdownItem'

export default {
  components: {
    Dropdown,
    DropdownItem
  },
  computed: {
    user() {
      return this.$page.auth?.user
    }
  }
}
</script>
