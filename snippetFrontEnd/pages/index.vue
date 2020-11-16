<template>
  <div>
    <div class="bg-white relative backgroundSS mb-16">
      <div class="container flex flex-wrap items-center lg:flex-no-wrap py-16 lg:py-32">
        <div class="overlay-secotion"></div>
        <div class="w-full relative lg:w-6/12">
          <h1 class="text-5xl font-medium text-gray-200 leading-tight mb-6">
            Browse and create mini step-by-step snippets
          </h1>
          <p class="text-xl text-gray-100 mb-12">
            Snippets are small collections of steps for things you don't need to remember
          </p>
          <nuxt-link :to="{
                      name: 'snippets-id',
                      params: {
                        id: SNIPPET_EX_UUID
                      }
                    }"
                    class="inline-block text-lg py-3 px-5 bg-gray-700 text-white rounded-lg"
                  >
                  Check out an example &rarr;
          </nuxt-link>
        </div>
        <div class="w-full relative lg:w-6/12">
          <img src="../assets/hero-7-img.png" alt="">
        </div>
      </div>
    </div>
    <div class="container">
      <h1 class="text-xl text-gray-600 font-medium mb-6">
        Latest snippets
      </h1>
      <LatestSnippetCard v-for="snippet in snippets" :key="snippet.uuid" :snippet="snippet"/>
    </div>
  </div>
</template>

<script>
import LatestSnippetCard from "./home/components/LatestSnippetCard"
export default {
    components: {
      LatestSnippetCard
    },
    head() {
      return {
        title: "Snippets",
        titleTemplate: null
      };
    },
    data() {
      return {
        snippets: [],
        SNIPPET_EX_UUID:process.env.SNIPPET_EX_UUID
      }
    },
    async asyncData({app}) {
      let snippets =  await app.$axios.$get('snippets?limit=10')
      return {
        snippets: snippets.data
      }
    },
  }
</script>

<style scoped>
.backgroundSS {
  background: linear-gradient(to top left, #56c6e6 0%, #1B9CFC 100%);
}

.overlay-secotion {
  background-image: url("../assets/hero-7-bg.png");
  background-repeat: no-repeat;
  opacity: 1;
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}
</style>
