<template>
  <div class="bg-gray-100 dark:bg-gray-900 dark:text-white h-screen flex">
    <div class="m-auto w-96 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
      <h1 class="font-bold text-center text-2xl mb-6">eAngkot Admin</h1>
      <breeze-validation-errors class="mb-4" />

      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <label for="email">Email</label>
          <input
            id="email"
            type="email"
            class="mt-1 border-none bg-gray-100 dark:bg-gray-700 block w-full rounded-md"
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
            class="mt-1 border-none bg-gray-100 dark:bg-gray-700 block w-full rounded-md"
            v-model="form.password"
            required
            autocomplete="current-password"
          />
        </div>

        <div class="flex items-center justify-end mt-6">
          <button
            class="
              w-full
              bg-indigo-600
              dark:bg-purple-600
              py-2
              px-4
              rounded-md
              text-white
            "
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

<script>
import BreezeValidationErrors from "@/Components/ValidationErrors";

export default {
  components: {
    BreezeValidationErrors,
  },

  props: {
    auth: Object,
    canResetPassword: Boolean,
    errors: Object,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("login"), {
        onFinish: () => this.form.reset("password"),
      });
    },
  },
};
</script>
