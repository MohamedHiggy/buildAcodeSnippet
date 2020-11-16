<template>
  <div>
    <div class="bg-white mb-16">
      <div class="container py-10 pb-16">
        <h1 class="text-4xl text-gray-700 font-medium leading-tight mb-4">
          {{user.name}}
        </h1>
        <div class="text-gray-500 font-medium">
          Member since {{joined}}
        </div>
      </div>
    </div>
    <div class="container">
      <template v-if="snippets.length">
        <h1 class="text-xl text-gray-600 font-medium mb-6">
          Public snippets ({{snippets.length}})
        </h1>
      </template>
      <template v-else>
        <h1 class="text-xl text-gray-600 font-medium mb-6">
          {{user.name}} don't have snippets
        </h1>
      </template>
      <SnippetCard v-for="snippet in snippets" :key="snippet.uuid" :snippet="snippet"/>
    </div>
  </div>
</template>

<script>
import moment from "moment"
import SnippetCard from "@/components/snippets/SnippetCard"
  export default {
    components: {
      SnippetCard
    },
    head() {
      return {
        title: `snippets by ${this.user.name}`
      };
    },
    data() {
      return {
        user: null,
        snippets: []
      }
    },
    computed: {
      joined() {
        return moment(this.user.joined, 'YYYY-MM-DD HH:mm:ss').format('Do MMMM YYYY')
      }
    },
    async asyncData({app, params}) {
      let user =  await app.$axios.$get(`users/${params.id}`)
      let snippets =  await app.$axios.$get(`users/${params.id}/snippets`)
      return {
        user: user.data,
        snippets: snippets.data
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>
