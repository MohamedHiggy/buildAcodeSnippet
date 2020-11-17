<template>
  <div class="container my-16">
    <div class="flex  flex-col  items-center">
      <div class="w-full  md:w-6/12 lg:w-4/12" v-if="image">
        <h1 class="text-2xl text-center w-full text-gray-700 font-small mb-10">
          Scan the QR code with your authenticator app
        </h1>
        <form action="#" class="mb-8" @submit.prevent="Submit">
          <div class="mb-6 ">
            <img :src="image" alt="OTP QR Code" class="w-full">
          </div>
          <div class="mb-6">
            <label
            :class="{ 'text-red-500': validation.reason }"
            for="otp" class="block text-gray-600 font-medium mb-2"
              >Code</label
            >
            <input
              :class="{ 'border-red-500': validation.reason }"
              autocomplete="off"
              type="text"
              class="border-2 border-gray-400 rounded block w-full p-3"
              name="otp"
              id="otp"
              v-model="form.otp"
            />
          <div
            v-if="validation.reason"
            class="text-red-500 mb-4 text-sm mt-1"
          >
            {{ validation.reason }}
          </div>
          </div>
          <div class="mb-6">
            <button
              class="bg-blue-500 text-white p-4 rounded text-center font-medium"
              type="submit"
            >
              submit
            </button>
          </div>
        </form>
      </div>
      <div class="w-full md:w-6/12 lg:w-4/12 mb-6" v-else>
        <h1 class="text-3xl text-gray-700 font-medium mb-10">
          No Qr code to scan
        </h1>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  head() {
    return {
      title: "enable otp"
    };
  },
  data() {
    return {
      validation: {},
      image: null,
      form: {
        otp: ""
      }
    };
  },
  methods: {
    async getOtpImage () {
        let response = await this.$axios.$get('http://localhost/api/auth/otp')
        this.image = response.data
    },
    async Submit() {
      try {
        await this.$axios.post('auth/otp', this.form);
        this.validation = {}
        await this.$auth.fetchUser();
        this.$router.push({
            name: 'account'
        })
      } catch (error) {
        if (error.response.status != 200) {
          this.validation = error.response.data.errors;
          if (error.response.status === 422) {
            this.$toast.error('The field is required.');
          }
          if (error.response.status === 401) {
            this.$toast.error('incorrect code');
          }
        }
      }
    }
  },
  mounted () {
    this.getOtpImage()
  }
};
</script>

<style lang="scss" scoped></style>
