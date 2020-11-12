<template>
  <div
    class="bg-white p-8 rounded-lg w-full mb-2 flex flex-wrap lg:flex-no-wrap justify-between items-center"
  >
    <div class="mr-8 mb-2 lg:mb-0">
      <h1 class="text-gray-600 text-xl leading-snug">
        <nuxt-link
        class="text-gray-600"
        :to="{
          name: 'snippets-id',
          params: {
            id: snippet.uuid
          }
        }">{{snippet.title || 'Untitled Snippet'}}</nuxt-link>
      </h1>
      <div class="text-gray-500 mr-6 font-medium">
        {{snippet.steps_count}} Steps
      </div>
    </div>
    <div>
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    snippet: {
      required: true,
      type: Object
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
