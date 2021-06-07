<template>
  <div
    class="
      container
      flex
      items-center
      justify-between
      md:justify-end
      h-full
      px-2
      md:px-6
      mx-auto
      text-indigo-600
      dark:text-purple-600
    "
  >
    <button
      @click="toggleSidebar"
      class="md:hidden focus:outline-none text-indigo-600 dark:text-purple-600"
    >
      <svg
        class="w-6 h-6"
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
    <ul class="flex items-center flex-shrink-0 space-x-6">
      <li class="relative">
        <div
          @click="toggleProfile"
          class="bg-gray-900 rounded-full w-8 h-8"
        ></div>
        <template v-if="profileMenuOpen">
          <profile-menu />
        </template>
      </li>
    </ul>
  </div>
</template>

<script>
import event from "@/eventBus";
import { ref } from "@vue/reactivity";
import ProfileMenu from "@/Components/Layouts/ProfileMenu";

export default {
  components: {
    ProfileMenu,
  },
  setup() {
    const profileMenuOpen = ref(false);
    const toggleSidebar = () => event.$emit("sidebar-toggle");

    const toggleProfile = () =>
      (profileMenuOpen.value = !profileMenuOpen.value);

    return { profileMenuOpen, toggleSidebar, toggleProfile };
  },
};
</script>
