<template>
    <SnippetCard :snippet="snippet">
        <ul class="flex items-end text-gray-600">
          <li class="mr-6">
            <template v-if="snippet.is_public">
              Public
            </template>
            <template v-else>
              Private
            </template>
          </li>
          <li class="mr-6">
            <nuxt-link
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4  border-blue-500 hover:border-transparent rounded"
            :to="{
              name: 'snippets-id-edit',
              params: {
                id: snippet.uuid
              }
            }">Edit</nuxt-link>
          </li>
          <li>
            <a href="#" @click.prevent="deleteSnippet">Delete</a>
          </li>
        </ul>
    </SnippetCard>
</template>

<script>
import SnippetCard from "@/components/snippets/SnippetCard"
  export default {
    components: {
      SnippetCard
    },
    methods: {
    async deleteSnippet() {
        if (!window.confirm('Are you sure you want to delete this snippet?')) {
          return
        }
        await this.$axios.$delete(`snippets/${this.snippet.uuid}`)
        this.$emit('deleted', this.snippet)
      }
    },
    props: {
      snippet: {
        required: true,
        type: Object
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
