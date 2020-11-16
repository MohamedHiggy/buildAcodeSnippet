<template>
  <div class="container my-16">
    <div class="flex flex-col items-center">
      <h1 class="text-3xl text-gray-700 font-medium mb-10">Hello!!</h1>
      <form
        action="#"
        class="bg-white p-8 rounded w-full md:w-6/12 lg:w-4/12 mb-6"
        @submit.prevent="Submit"
      >
        <div class="mb-6">
          <label
            :class="{ 'text-red-500': validation.email }"
            for="Email"
            class="block text-gray-600 font-medium mb-2"
            >Email address</label
          >
          <input
            :class="{ 'border-red-500': validation.email }"
            type="email"
            class="border-2 border-gray-400 rounded block w-full p-3"
            name="email"
            id="email"
            v-model="form.email"
          />
          <div v-if="validation.email" class="text-red-500 mb-4 text-sm mt-1">
            {{ validation.email[0] }}
          </div>
        </div>
        <div class="mb-6">
          <label
            :class="{ 'text-red-500': validation.password }"
            for="password"
            class="block text-gray-600 font-medium mb-2"
            >Password</label
          >
          <input
            :class="{ 'border-red-500': validation.password }"
            type="password"
            class="border-2 border-gray-400 rounded block w-full p-3"
            name="password"
            id="password"
            v-model="form.password"
          />
          <div
            v-if="validation.password"
            class="text-red-500 mb-4 text-sm mt-1"
          >
            {{ validation.password[0] }}
          </div>
        </div>
        <div class="mb-6">
          <button
            class="bg-blue-500 text-white p-4 rounded text-center font-medium block w-full"
            type="submit"
          >
            Login
          </button>
        </div>
      </form>
      <div class="text-center text-gray-600">
        No account ?
        <nuxt-link :to="{ name: 'index' }">Create one</nuxt-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      validation: {},
    };
  },
  head() {
    return {
      title: "Login in",
    };
  },
  methods: {
    async Submit() {
      try {
        await this.$auth.loginWith("local", {
          data: this.form,
        });
        this.$toast.success('successfuly authenticated');
      } catch (error) {
        if (error.response.status === 422) {
          this.validation = error.response.data.errors;
          this.$toast.error('authentication failed');
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
