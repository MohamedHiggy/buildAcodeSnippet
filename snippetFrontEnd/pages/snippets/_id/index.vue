<template>
  <div>
    <div class="bg-white  mb-16">
      <div class="container py-10 pb-16">
        <div class="w-10/12">
          <h1 class="text-4xl text-gray-700 font-medium leading-tight mb-2">
            Snippet Title
          </h1>
          <div class="text-gray-600">
            Created by <nuxt-link :to="{}">user name</nuxt-link>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <h1 class="text-xl text-gray-600 font-medium mb-6">1/1. step title</h1>
      <div class="flex flex-wrap lg:flex-no-wrap">
        <!--______________ Left content ______________-->
        <div
          class="w-full lg:w-8/12 lg:mr-16 flex flex-wrap lg:flex-no-wrap justify-between items-start mb-8"
        >
          <div class="order-first">
            <nuxt-link
              :to="{}"
              class="block mb-2 p-3 bg-blue-500 rounded-lg mr-2"
            >
              <svg
                class="fill-current text-white h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
              >
                <path
                  class="heroicon-ui"
                  d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"
                />
              </svg>
            </nuxt-link>
          </div>
          <div class="bg-white p-8 rounded-lg text-gray-600 w-full">
            Markdown content
          </div>
          <div class="flex flex-row lg:flex-col order-first lg:order-last">
            <nuxt-link
              :to="{}"
              class="block mb-2 p-3 bg-blue-500 rounded-lg ml-2"
              ><svg
                class="fill-current text-white h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
              >
                <path
                  class="heroicon-ui"
                  d="M18.59 13H3a1 1 0 0 1 0-2h15.59l-5.3-5.3a1 1 0 1 1 1.42-1.4l7 7a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.42-1.4l5.3-5.3z"
                /></svg
            ></nuxt-link>

            <nuxt-link
              :to="{}"
              class="block mb-2 p-3 bg-blue-500 rounded-lg ml-2 order-first lg:order-last"
              title="Edit step"><svg
                class="fill-current text-white h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
              >
                <path
                  class="heroicon-ui"
                  d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"
                />
              </svg> </nuxt-link>
          </div>
        </div>
        <!--______________ Right content ______________-->
        <div class="w-full lg:w-4/12">
          <div class="mb-8">
            <h1 class="text-xl text-gray-600 font-medium mb-6">Steps</h1>
            <ul>
              <li class="mb-1" v-for="(step, index) in 5" :key="index">
                <nuxt-link :to="{}" :class="{'font-bold': index === 0}">{{index + 1}}. step title</nuxt-link>
              </li>
            </ul>
          </div>
          <div class="text-gray-500 text-sm">
            Use
            <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">ctrl</div>
            + <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">shift</div>
            + <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">left or right</div>
            on your keyboard to navigation between steps
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped></style>
