<template>
  <nuxt-link
      :to="step ? {
        query: {
          step : step.uuid
        }
      } : {}"
      class="block mb-2 p-3 bg-blue-500 rounded-lg "
      :class="{
        'opacity-25 cursor-not-allowed': !step
      }"
      title="step Btn"
  >
    <slot />
  </nuxt-link>
</template>

<script>
export default {
  props: {
    step: {
      required: true
    }
  }
};
</script>
