<template>
  <div>
    <div class="bg-white  mb-16">
      <div class="container py-10 pb-16">
        <div class="w-10/12">
          <input
            type="text"
            value=""
            placeholder="Untitled snippet"
            class="p-2 border-2 rounded border-dashed font-header text-4xl w-full block text-gray-700 font-medium leading-tight mb-2"
          />
          <div class="text-gray-600">
            Created by <nuxt-link :to="{}">user name</nuxt-link>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="flex items-center mb-6">
        <div class="text-xl text-gray-600 font-medium mr-3">
          1/5
        </div>
        <input
          type="text"
          value=""
          class="text-xl text-gray-600 font-medium  py-1 p-2 border-2 bg-transparent rounded border-dashed  w-full"
          placeholder="Untitled snippet"
        />
      </div>
      <div class="flex flex-wrap lg:flex-no-wrap">

        <!--______________ Left content ______________-->
        <div
          class="w-full lg:w-8/12 lg:mr-16 flex flex-wrap lg:flex-no-wrap justify-between items-start mb-8"
        >
          <div class="order-first flex flex-row lg:flex-col order-first">
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

            <nuxt-link
              :to="{}"
              class="block mb-2 p-3 bg-blue-500 rounded-lg mr-2"
              >
            <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/></svg>
            </nuxt-link>
          </div>

            <div class="w-full lg:mr-2">
              <textarea class="w-full mb-6 border-2 border-gray-400 rounded-lg border-dashed" ></textarea>
              <div class="bg-white p-8 rounded-lg text-gray-600 w-full">
                Markdown content
              </div>
            </div>

          <div class="flex lg:flex-col flex-row-reverse order-first lg:order-last">

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
              class="block mb-2 p-3 bg-blue-500 rounded-lg ml-2"
              >
            <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/></svg>
            </nuxt-link>
            <nuxt-link
              :to="{}"
              class="block mb-2 p-3 bg-blue-500 rounded-lg ml-2"
              title="Delete step"
              >
              <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/></svg>
            </nuxt-link>
          </div>
        </div>

        <!--______________ Right content ______________-->
        <div class="w-full lg:w-4/12">
          <div class="mb-8">
            <h1 class="text-xl text-gray-600 font-medium mb-6">Steps</h1>
            <ul>
              <li class="mb-1" v-for="(step, index) in 5" :key="index">
                <nuxt-link :to="{}" :class="{ 'font-bold': index === 0 }"
                  >{{ index + 1 }}. step title</nuxt-link
                >
              </li>
            </ul>
          </div>
          <div class="text-gray-500 text-sm">
            Use
            <div
              class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm"
            >
              ctrl
            </div>
            +
            <div
              class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm"
            >
              shift
            </div>
            +
            <div
              class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm"
            >
              left or right
            </div>
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