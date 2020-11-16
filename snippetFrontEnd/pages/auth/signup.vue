<template>
  <div class="container my-16">
    <div class="flex flex-col items-center">
      <h1 class="text-3xl text-gray-700 font-medium mb-10">Get snippeting.</h1>
      <form
        action="#"
        class="bg-white p-8 rounded w-full md:w-8/12 lg:w-7/12 mb-6"
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

        <div class="flex flex-wrap lg:flex-no-wrap">
          <div class="lg:mr-6 w-full lg:w-6/12 mb-6">
            <label
              :class="{ 'text-red-500': validation.name }"
              for="Name"
              class="block text-gray-600 font-medium mb-2"
              >Name</label
            >
            <input
              :class="{ 'border-red-500': validation.name }"
              type="text"
              class="border-2 border-gray-400 rounded block w-full p-3"
              name="name"
              id="name"
              v-model="form.name"
            />
            <div v-if="validation.name" class="text-red-500 mb-4 text-sm mt-1">
              {{ validation.name[0] }}
            </div>
          </div>
          <div class="w-full lg:w-6/12 mb-6">
            <label
              :class="{ 'text-red-500': validation.username }"
              for="Username"
              class="block text-gray-600 font-medium mb-2"
              >Username</label
            >
            <input
              :class="{ 'border-red-500': validation.username }"
              type="text"
              class="border-2 border-gray-400 rounded block w-full p-3"
              name="username"
              id="username"
              v-model="form.username"
            />
            <div
              v-if="validation.username"
              class="text-red-500 mb-4 text-sm mt-1"
            >
              {{ validation.username[0] }}
            </div>
          </div>
        </div>

        <div class="flex flex-wrap lg:flex-no-wrap">
          <div class="lg:mr-6 w-full lg:w-6/12 mb-6">
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

          <div class="w-full lg:w-6/12 mb-6">
            <label
              :class="{ 'text-red-500': validation.password_confirmation }"
              for="password_confirmation"
              class="block text-gray-600 font-medium mb-2"
              >password Confirmation</label
            >
            <input
              :class="{ 'border-red-500': validation.password_confirmation }"
              type="password"
              class="border-2 border-gray-400 rounded block w-full p-3"
              name="password_confirmation"
              id="password_confirmation"
              v-model="form.password_confirmation"
            />
            <div
              v-if="validation.password_confirmation"
              class="text-red-500 mb-4 text-sm mt-1"
            >
              {{ validation.password_confirmation[0] }}
            </div>
          </div>
        </div>

        <div class="mb-6">
          <button
            class="bg-blue-500 text-white p-4 rounded text-center font-medium block w-full"
            type="submit"
          >
            Create
          </button>
        </div>
      </form>
      <div class="text-center text-gray-600">
        Already got an account ?
        <nuxt-link :to="{ name: 'auth-login' }">Sign one here</nuxt-link>
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
        name: "",
        username: "",
        password: "",
        password_confirmation: ""
      },
      validation: {}
    };
  },
  head() {
    return {
      title: "Create account"
    };
  },
  methods: {
    async Submit() {
      try {
        await this.$axios.$post("auth/signup", this.form);
        await this.$auth.loginWith("local", {
          data: {
            email: this.form.email,
            password: this.form.password
          }
        });
        this.$toast.success('successfuly created account');
      } catch (error) {
        if (error.response.status === 422) {
          this.validation = error.response.data.errors;
          this.$toast.error('something went wrong when you creating account');
        }
      }
    }
  }
};
</script>

<style lang="scss" scoped></style>
