<template>
  <div class="container my-16">
    <div class="flex flex-col items-center">
      <h1 class="text-3xl text-gray-700 font-medium mb-10">
        {{ $auth.user.name }}
      </h1>
      <div class="w-full md:w-6/12 lg:w-4/12 mb-6">
          <form
            action="#"
            class="mb-8"
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
            <div class="mb-6">
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
              <div v-if="validation.username" class="text-red-500 mb-4 text-sm mt-1">
                {{ validation.username[0] }}
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
              <div class="text-sm text-gray-500">
                Leave blank to keep the same
              </div>
            </div>
            <div class="mb-6">
              <button
                class="bg-blue-500 text-white p-4 rounded text-center font-medium"
                type="submit"
              >
                Update
              </button>
            </div>
          </form>
          <div class="text-gray-600">
          <nuxt-link
            :to="{
              name: 'author-id',
              params: {
                id: $auth.user.username
              }
            }"
            >View your public profile</nuxt-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: this.$auth.user.email,
        name: this.$auth.user.name,
        username: this.$auth.user.username,
        password: ""
      },
      validation: {}
    };
  },
  head() {
    return {
      title: "Account"
    };
  },
  methods: {
    async Submit() {
      try {
        await this.$axios.patch(`users/${this.$auth.user.username}`, this.form);
        //fun fetchUser() to update data in store that created bu auth/nuxt
        await this.$auth.fetchUser();
        this.form.password = ''
        this.validation = {}
      } catch (error) {
        if (error.response.status === 422) {
          this.validation = error.response.data.errors;
        }
      }
    }
  }
};
</script>

<style lang="scss" scoped></style>
