<template>
  <div
    class="h-full flex flex-col py-4 bg-white dark:bg-gray-800 dark:text-white"
  >
    <h1 class="text-xl font-bold text-center">eAngkot</h1>

    <ul class="mt-6">
      <li v-for="route in routes" :key="route.name" class="relative px-4 py-1">
        <inertia-link
          :href="route.url"
          as="button"
          class="inline-flex items-center p-2 w-full font-semibold focus:outline-none"
          :class="{
            'text-gray-50 hover:text-gray-200 bg-indigo-600 dark:bg-indigo-500 rounded-md':
              route.name == currentRoute,
            'text-gray-700 hover:text-black dark:text-gray-50 dark:hover:text-gray-300':
              route.name != currentRoute,
          }"
        >
          <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            v-html="route.icon"
          ></svg>
          <span class="ml-4">{{ route.label }}</span>
        </inertia-link>
      </li>
      <li class="relative px-4 py-1">
        <button
          class="inline-flex items-center p-2 w-full font-semibold justify-between text-gray-700 hover:text-black dark:text-gray-50 dark:hover:text-gray-300 focus:outline-none"
          @click="akunMenuOpen = !akunMenuOpen"
        >
          <span class="inline-flex items-center">
            <svg
              class="w-5 h-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              v-html="akunRoute.icon"
            ></svg>
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
          class="p-2 mt-2 space-y-2 overflow-hidden font-medium rounded-md shadow-inner text-gray-700 dark:text-gray-50 bg-gray-50 dark:bg-gray-900"
        >
          <li v-for="route in akunRoute.routes">
            <inertia-link
              :href="route.url"
              class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              :class="{
                'bg-indigo-600 dark:bg-indigo-600 text-gray-50':
                  currentRoute === route.name,
              }"
            >
              {{ route.label }}
            </inertia-link>
          </li>
        </ul>
      </li>
      <li class="relative px-4 py-1">
        <button
          class="inline-flex items-center p-2 w-full font-semibold justify-between text-gray-700 hover:text-black dark:text-gray-50 dark:hover:text-gray-300 focus:outline-none"
          @click="pengajuanMenuOpen = !pengajuanMenuOpen"
        >
          <span class="inline-flex items-center">
            <svg
              class="w-5 h-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              v-html="pengajuanRoute.icon"
            ></svg>
            <span class="ml-4">Pengajuan</span>
          </span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              v-if="pengajuanMenuOpen"
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
          v-show="pengajuanMenuOpen"
          class="p-2 mt-2 space-y-2 overflow-hidden font-medium rounded-md shadow-inner text-gray-700 dark:text-gray-50 bg-gray-50 dark:bg-gray-900"
        >
          <li v-for="route in pengajuanRoute.routes">
            <inertia-link
              :href="route.url"
              class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              :class="{
                'bg-indigo-600 dark:bg-indigo-600 text-gray-50':
                  currentRoute === route.name,
              }"
            >
              {{ route.label }}
            </inertia-link>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import event from "@/eventBus";

export default {
  setup() {
    const akunMenuOpen = ref(false);
    const pengajuanMenuOpen = ref(false);
    const currentRoute = ref(route().current());
    const routes = [
      {
        name: "admin.home.index",
        label: "Home",
        url: route("admin.home.index"),
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>`,
      },
      {
        name: "admin.angkot.index",
        label: "Angkot",
        url: route("admin.angkot.index"),
        icon: `<path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>`,
      },
      {
        name: "admin.trayek.index",
        label: "Trayek",
        url: route("admin.trayek.index"),
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>`,
      },
    ];
    const akunRoute = {
      icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>`,
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
    };
    const pengajuanRoute = {
      icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>`,
      routes: [
        {
          name: "admin.pengajuan.bonus.index",
          label: "Bonus",
          url: route("admin.pengajuan.bonus.index"),
        },
        {
          name: "admin.pengajuan.driver.index",
          label: "Driver",
          url: route("admin.pengajuan.driver.index"),
        },
      ],
    };

    onMounted(() => {
      if (currentRoute.value.includes("akun")) akunMenuOpen.value = true;
      if (currentRoute.value.includes("pengajuan")) pengajuanMenuOpen.value = true;
      event.$on(
        "page-navigation",
        () => (currentRoute.value = route().current())
      );
    });

    return {
      akunMenuOpen,
      pengajuanMenuOpen,
      currentRoute,
      routes,
      akunRoute,
      pengajuanRoute,
    };
  },
};
</script>
