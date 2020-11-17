<template>
  <div class="container my-16">
    <div class="flex  flex-col  items-center">
      <div class="w-full  md:w-6/12 lg:w-4/12">
        <h1 class="text-2xl text-center w-full text-gray-700 font-small mb-10">
          You must type your password to disabele two factor auth
        </h1>
        <form
        action="#"
        class="bg-white p-8 rounded w-full  mb-6"
        @submit.prevent="Submit"
      >
        <div class="mb-6">
          <label
            for="password"
            class="block text-gray-600 font-medium mb-2"
            >Password</label
          >
          <input
            type="password"
            class="border-2 border-gray-400 rounded block w-full p-3"
            name="password"
            id="password"
            v-model="form.password"
          />
        </div>
        <div class="mb-6">
          <button
            class="bg-blue-500 text-white p-4 rounded text-center font-medium block w-full"
            type="submit"
          >
            Submit
          </button>
        </div>
      </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  head() {
    return {
      title: "disable otp"
    };
  },
  data () {
    return {
      form: {
        password: ''
      }
    }
  },
  methods: {
    async Submit() {
      try {
        await this.$axios.$delete("http://localhost/api/auth/otp", {
          data: {
            ...this.form
          }
        });
        this.$toast.success('successfuly deleted');
      } catch (error) {
        if (error.response.status === 422) {
          this.$toast.error('failed');
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
