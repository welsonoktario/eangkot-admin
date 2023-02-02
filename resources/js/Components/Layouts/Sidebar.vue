<template>
  <transition name="fade" mode="out-in">
    <div
      v-if="sidebarOpen"
      class="absolute inset-0 z-40 mt-16 w-screen bg-gray-900 opacity-75"
      @click="sidebarOpen = !sidebarOpen"
    ></div>
  </transition>
  <transition
    enter-from-class="transform -translate-x-20 opacity-0"
    enter-active-class="transition duration-150 ease-in-out"
    enter-to-class="opacity-100"
    leave-from-class="opacity-100"
    leave-active-class="transition duration-150 ease-in-out"
    leave-to-class="transform -translate-x-20 opacity-0"
    mode="in-out"
  >
    <aside
      v-if="sidebarOpen || currentWidth >= 768"
      class="fixed inset-y-0 z-50 col-span-2 mt-16 w-full flex-shrink-0 border-r border-gray-100 bg-white py-4 dark:bg-gray-800 dark:text-white md:static md:mt-0 md:block"
      :class="{ hidden: !sidebarOpen }"
    >
      <h1 class="text-center text-xl font-bold">eAngkot</h1>

      <ul class="mt-6">
        <li
          v-for="route in routes"
          :key="route.name"
          class="relative px-4 py-2"
        >
          <Link
            :href="route.url"
            @click="navigation(route.name)"
            as="button"
            class="inline-flex w-full items-center p-2 font-semibold focus:outline-none"
            :class="{
              'text-indigo-500 hover:text-indigo-400 dark:text-indigo-400 dark:hover:text-indigo-300':
                route.name == currentRoute,
              'text-gray-700 hover:text-black dark:text-gray-50 dark:hover:text-gray-300':
                route.name != currentRoute,
            }"
          >
            <component :is="route.icon" class="h-5 w-5"></component>
            <span class="ml-4">{{ route.label }}</span>
          </Link>
        </li>
        <li class="relative px-4 py-2">
          <button
            class="inline-flex w-full items-center justify-between p-2 font-semibold text-gray-700 hover:text-black focus:outline-none dark:text-gray-50 dark:hover:text-gray-300"
            @click="akunMenuOpen = !akunMenuOpen"
          >
            <span class="inline-flex items-center">
              <component :is="akunRoute.icon" class="h-5 w-5"></component>
              <span class="ml-4">Akun</span>
            </span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                v-if="akunMenuOpen"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"
              />
              <path
                v-else
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
              />
            </svg>
          </button>
          <ul
            v-show="akunMenuOpen"
            class="mt-2 space-y-2 overflow-hidden rounded-md bg-gray-50 p-2 font-medium text-gray-700 dark:bg-gray-900 dark:text-gray-50"
          >
            <li v-for="route in akunRoute.routes" :key="route.name">
              <Link
                as="button"
                :href="route.url"
                @click="navigation(route.name)"
                class="w-full px-2 py-1 text-left transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                :class="{
                  'rounded-md bg-indigo-600 text-gray-50 dark:bg-indigo-600':
                    currentRoute === route.name,
                }"
              >
                {{ route.label }}
              </Link>
            </li>
          </ul>
        </li>
      </ul>
    </aside>
  </transition>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3"
import { onBeforeMount, onMounted, ref } from "vue"
import event from "@/eventBus"
import {
  DocumentTextIcon,
  HomeIcon,
  MapIcon,
  TruckIcon,
  UsersIcon,
} from "@heroicons/vue/24/solid"

const akunMenuOpen = ref(false)
const pengajuanMenuOpen = ref(false)
const sidebarOpen = ref(false)
const currentRoute = ref(route().current())
const currentWidth = ref(window.innerWidth)
const routes = [
  {
    name: "admin.home.index",
    label: "Home",
    url: route("admin.home.index"),
    icon: HomeIcon,
  },
  {
    name: "admin.angkot.index",
    label: "Angkot",
    url: route("admin.angkot.index"),
    icon: TruckIcon,
  },
  {
    name: "admin.trayek.index",
    label: "Trayek",
    url: route("admin.trayek.index"),
    icon: MapIcon,
  },
  {
    name: "admin.pengajuan-driver.index",
    label: "Pengajuan Driver",
    url: route("admin.pengajuan-driver.index"),
    icon: DocumentTextIcon
  },
]
const akunRoute = {
  icon: UsersIcon,
  routes: [
    {
      name: "admin.akun.driver.index",
      label: "Driver",
      url: route("admin.akun.driver.index"),
    },
    {
      name: "admin.akun.user.index",
      label: "User",
      url: route("admin.akun.user.index"),
    },
  ],
}

const onCurrentWidthChange = () => {
  if (window.innerWidth >= 768) sidebarOpen.value = false
  currentWidth.value = window.innerWidth
}

const navigation = (name) => {
  currentRoute.value = name
  if (window.innerWidth <= 768) sidebarOpen.value = false
}

onMounted(() => {
  window.addEventListener("resize", onCurrentWidthChange)
  if (currentRoute.value.includes("akun")) akunMenuOpen.value = true
  if (currentRoute.value.includes("pengajuan")) pengajuanMenuOpen.value = true
  event.$on("sidebar-toggle", () => {
    sidebarOpen.value = !sidebarOpen.value
  })
})

onBeforeMount(() => window.removeEventListener("resize", onCurrentWidthChange))
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.15s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
