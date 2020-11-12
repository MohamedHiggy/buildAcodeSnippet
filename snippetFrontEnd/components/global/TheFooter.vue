<template>
  <div class="mt-24 mb-12">
    <div class="container flex flex-wrap lg:flex-no-wrap justify-between">
      <ul class="flex items-center mb-6 lg:mb-0">
        <li class="mr-16">
          <nuxt-link :to="{
            name: 'index'
          }" class="text-gray-500 text-sm mb-2 inline-block">Home</nuxt-link>

          <div class="text-gray-500 text-sm">
            &copy; All rights reserved.
          </div>
        </li>
          <li class="mr-16">
            <nuxt-link :to="{
              name: 'browse'
            }" class="text-gray-500 text-sm mb-2 inline-block">All snippets</nuxt-link>

          </li>
      </ul>
      <ul class="flex flex-wrap lg:flex-no-wrap items-end">
        <li class="mr-8 w-full lg:w-auto">
          <a
            target="_blank"
            href="https://github.com/MohamedHiggy"
            class="text-gray-500 text-sm"
            rel="noopener"
            >
            Mohamed Higgy</a>
        </li>
        <li class="mr-8 w-full lg:w-auto">
          <a
            href="#"
            class="text-gray-500 text-sm">
            Terms</a>
        </li>
        <li class="mr-8 w-full lg:w-auto">
          <a
            href="#"
            class="text-gray-500 text-sm">
            Privacy policy</a>
        </li>
        <li class="mr-8 w-full lg:w-auto">
          <a
            href="mailto:mohamed.higgy31@gmail.com<"
            class="text-gray-500 text-sm">
            mohamed.higgy31@gmail.com</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {

  }
</script>

<style lang="scss" scoped>

</style>
