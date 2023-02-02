<template>
  <div
    class="container mx-auto flex h-full items-center justify-between px-6 text-indigo-600 dark:text-indigo-600 md:justify-end"
  >
    <button
      @click="toggleSidebar"
      class="text-indigo-600 focus:outline-none dark:text-indigo-600 md:hidden"
    >
      <svg
        class="h-6 w-6"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"
        ></path>
      </svg>
    </button>
    <ul class="flex flex-shrink-0 items-center space-x-6">
      <li class="relative">
        <img
          @click="toggleProfile"
          class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-900"
          :src="`https://ui-avatars.com/api/?name=${user.nama}`"
          width="100%"
        />
        <template v-if="profileMenuOpen">
          <ProfileMenu :user="user" />
        </template>
      </li>
    </ul>
  </div>
</template>

<script setup>
import event from "@/eventBus"
import { computed, ref } from "vue"
import ProfileMenu from "@components/Layouts/ProfileMenu.vue"
import { usePage } from "@inertiajs/inertia-vue3"

const page = usePage()
const user = computed(() => page.props.value.auth.user)

const profileMenuOpen = ref(false)
const toggleSidebar = () => event.$emit("sidebar-toggle")

const toggleProfile = () => (profileMenuOpen.value = !profileMenuOpen.value)
</script>
