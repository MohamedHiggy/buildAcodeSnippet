<template>
  <div class="container mt-16">
    <div class="flex justify-between">
      <template v-if="snippets.length">
        <h1 class="text-xl text-gray-600 font-medium mb-6">Your snippets ({{snippets.length}})</h1>
      </template>
      <template v-else>
        <h1 class="text-xl text-gray-600 font-medium mb-6">You don't have any snippet</h1>
      </template>
      <a href="#" @click.prevent="createSnippet">+ Create a snippet</a>
    </div>
    <div v-if="snippets.length === 0" class="text-gray-600 font-medium">
      there is no snippets here. You know what to do.
    </div>
    <DashboardSnippetCard @deleted="removeSnippet" v-for="snippet in snippets" :key="snippet.uuid" :snippet="snippet"/>
  </div>
</template>

<script>
import DashboardSnippetCard from "./components/DashboardSnippetCard"
  export default {
    middleware: ["auth"],
    head() {
      return {
        title: "Dashboard"
      };
    },
    components:{ DashboardSnippetCard },
    data() {
      return {
        snippets: []
      }
    },
    methods: {
      async createSnippet() {
        let snippet = await this.$axios.$post('snippets');
        this.$router.push({
          name: 'snippets-id-edit',
          params: {
            id: snippet.data.uuid
          }
        })
        this.$toast.success('successfuly snippet created');
      },
      removeSnippet(snippet) {
        this.snippets = this.snippets.filter((e) => e.uuid !== snippet.uuid)
        this.$toast.info('successfuly snippet deleted');
      }
    },
    async asyncData({app}) {
      let snippets =  await app.$axios.$get('me/snippets')
      return {
        snippets: snippets.data
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>
