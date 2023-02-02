<template>
  <div class="flex h-screen bg-gray-100 dark:bg-gray-900 dark:text-white">
    <div class="m-auto w-96 rounded-lg bg-white p-6 shadow-md dark:bg-gray-800">
      <h1 class="mb-6 text-center text-2xl font-bold">eAngkot Admin</h1>
      <breeze-validation-errors class="mb-4" />

      <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <label for="email">Email</label>
          <input
            id="email"
            type="email"
            class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
            v-model="form.email"
            required
            autofocus
            autocomplete="username"
          />
        </div>

        <div class="mt-4">
          <label for="password">Password</label>
          <input
            id="password"
            type="password"
            class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
            v-model="form.password"
            required
            autocomplete="current-password"
          />
        </div>

        <div class="mt-6 flex items-center justify-end">
          <button
            class="w-full rounded-md bg-indigo-600 py-2 px-4 text-white dark:bg-indigo-500 dark:hover:bg-indigo-400"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Log in
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import BreezeValidationErrors from "@components/ValidationErrors.vue"
import { useForm } from "@inertiajs/inertia-vue3"

const props = defineProps({
  auth: Object,
  canResetPassword: Boolean,
  errors: Object,
  status: String,
})

const form = useForm({
  email: "",
  password: "",
})

const submit = () =>
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  })
</script>
