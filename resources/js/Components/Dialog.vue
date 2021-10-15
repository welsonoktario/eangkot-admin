<template>
  <TransitionRoot appear :show="open" as="template">
    <Dialog as="div" @close="open = !open">
      <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
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

          <span class="inline-block h-screen align-middle" aria-hidden="true">
            &#8203;
          </span>

          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <div
              class="
                inline-block
                w-full
                max-w-md
                p-6
                my-8
                overflow-hidden
                text-left
                align-middle
                transition-all
                transform
                bg-white
                dark:bg-gray-800
                shadow-xl
                rounded-2xl
              "
            >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                <slot name="title"></slot>
              </DialogTitle>
              <div class="mt-6 text-sm">
                <slot name="content"></slot>
              </div>

              <div class="mt-4 flex flex-row justify-end">
                <slot name="footer"></slot>
              </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { onMounted, ref } from "vue";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
} from "@headlessui/vue";
import eventBus from "@/eventBus";

export default {
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
  },
  setup() {
    const open = ref(false);

    onMounted(() =>
      eventBus.$on("modal-toggle", () => (open.value = !open.value))
    );

    return { open };
  },
};
</script>
