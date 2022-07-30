<template>
  <TransitionRoot appear :show="open" as="template">
    <Dialog as="div" @close="open = !open">
      <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay class="fixed inset-0">
              <div class="absolute inset-0 bg-gray-900 opacity-50" />
            </DialogOverlay>
          </TransitionChild>

          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="inline-block w-full max-w-md p-6 my-auto overflow-y-auto text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl dark:bg-gray-800"
            >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-50"
              >
                <slot name="title"></slot>
              </DialogTitle>
              <div class="mt-6 text-sm">
                <slot name="content"></slot>
              </div>

              <div class="flex flex-row justify-end mt-4">
                <slot name="footer"></slot>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { onMounted, ref } from "vue";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogOverlay,
  DialogTitle,
} from "@headlessui/vue";
import eventBus from "@/eventBus";

const open = ref(false);

onMounted(() => eventBus.$on("modal-toggle", () => (open.value = !open.value)));
</script>
