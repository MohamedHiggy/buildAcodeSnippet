<template>
  <div>
    <div class="bg-white  mb-16">
      <div class="container py-10 pb-16">
        <div class="w-10/12">
          <input
            type="text"
            value=""
            v-model="snippet.title"
            placeholder="Untitled snippet"
            class="p-2 border-2 rounded border-dashed font-header text-4xl w-full block text-gray-700 font-medium leading-tight mb-2"
          />
          <div class="text-gray-600">
            Created by <nuxt-link :to="{
              name: 'author-id',
              params: {
                id: snippet.author.data.username
              }
            }">{{snippet.author.data.name}}</nuxt-link>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="flex items-center mb-6">
        <div class="text-xl text-gray-600 font-header font-medium mr-3">
        {{currentStepIndex + 1}}/{{steps.length}}
        </div>
        <input
          type="text"
          value=""
          class="text-xl text-gray-600 font-medium font-header py-1 p-2 border-2 bg-transparent rounded border-dashed  w-full"
          placeholder="Untitled snippet"
          v-model="currentStep.title"
        />
      </div>
      <div class="flex flex-wrap lg:flex-no-wrap">
        <!--______________ Left content ______________-->
        <div
          class="w-full lg:w-8/12 lg:mr-16 flex flex-wrap lg:flex-no-wrap justify-between items-start mb-8"
        >
          <div class="order-first flex flex-row lg:flex-col order-first mr-2">
            <StepNavBtn :step="prevStep">
              <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="heroicon-ui" d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/>
              </svg>
            </StepNavBtn>
            <AddStepBtn @added="handleStepAdded" position="before" :snippet="snippet" :currentStep="currentStep" />
          </div>

          <div class="w-full lg:mr-2">
            <StepEditor v-model="currentStep.body" :step="currentStep"/>
          </div>

          <div class="flex lg:flex-col flex-row-reverse order-first lg:order-last">
            <StepNavBtn :step="nextStep">
              <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" >
                <path class="heroicon-ui" d="M18.59 13H3a1 1 0 0 1 0-2h15.59l-5.3-5.3a1 1 0 1 1 1.42-1.4l7 7a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.42-1.4l5.3-5.3z" />
              </svg>
            </StepNavBtn>
            <AddStepBtn @added="handleStepAdded" position="after" :snippet="snippet" :currentStep="currentStep" />
            <DeleteStepBtn @deleted="handleStepDeleted" v-if="steps.length > 1" :snippet="snippet" :currentStep="currentStep"/>
          </div>
        </div>

        <!--______________ Right content ______________-->
        <div class="w-full lg:w-4/12">
          <div class="mb-8">
            <h1 class="text-xl text-gray-600 font-medium mb-6">Steps</h1>
            <StepList
              :steps="orderedStepsAsc"
              :currentStep="currentStep"
            ></StepList>
          </div>
          <div class="border-t-2 border-gray-300 py-6">
            <h1 class="text-xl text-gray-600 font-medium mb-6">Publishing</h1>
            <div class="text-gray-500 text-sm mb-6">
              <template v-if="lastSaved">
                Last saved at {{lastSavedFormatted}}
              </template>
              <template v-else>
                No changes saved in this session yet
              </template>
            </div>
            <div class="flex items-baseline">
              <input v-model="snippet.is_public" type="checkbox" class="mr-2" name="public" id="public">
              <div>
                <label for="public" class="text-gray-600 font-medium">
                  Make this snippet public
                </label>
                <div class="text-gray-500 text-sm">
                  Don't worry, you can change this later.
                </div>
              </div>
            </div>
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
import StepList from "../components/StepList";
import StepNavBtn from "../components/StepNavBtn";
import AddStepBtn from "./components/AddStepBtn";
import DeleteStepBtn from "./components/DeleteStepBtn";
import StepEditor from "./components/StepEditor";
import { debounce as _debounce } from "lodash";
import browseSnippet from "@/mixins/snippets/browseSnippet"
import moment from "moment"
export default {
  middleware: ["auth"],
  head() {
    return {
      title: `Editing ${this.snippet.title || "Untitled snippet"}`
    };
  },
  components: {
    StepList,
    StepNavBtn,
    AddStepBtn,
    DeleteStepBtn,
    StepEditor
  },
  data() {
    return {
      snippet: null,
      steps: [],
      lastSaved: null
    };
  },
  mixins: [browseSnippet],
  methods: {
    touchLastSaved () {
      this.lastSaved = moment.now()
    },
    handleStepAdded(step) {
      this.steps.push(step);
      this.goToStep(step)
    },
    handleStepDeleted(step) {
      let prevStep = this.prevStep
      this.steps = this.steps.filter((e) => {
        return e.uuid !== step.uuid
      })
      this.goToStep(prevStep || this.firstStep)
    }
  },
  computed: {
    lastSavedFormatted() {
      return moment(this.lastSaved).format('hh:mm:ss')
    }
  },
  watch: {
    //update snippet when typing
    "snippet.title": {
      handler: _debounce(async function(title) {
        console.log(title);
        await this.$axios.$patch(`snippets/${this.snippet.uuid}`, {
          title
        });
        this.touchLastSaved();
      }, 1000)
    },
    //update snippet privacy
    "snippet.is_public": {
      handler: _debounce(async function(isPublic) {
        console.log(isPublic);
        await this.$axios.$patch(`snippets/${this.snippet.uuid}`, {
          is_public : isPublic
        });
        this.touchLastSaved();
      }, 1000)
    },
    //update snippet step when typing
    currentStep: {
      deep: true,
      handler: _debounce(async function(step) {
        await this.$axios.$patch(
          `snippets/${this.snippet.uuid}/steps/${step.uuid}`,
          {
            title: step.title,
            body: step.body
          }
        );
        this.touchLastSaved();
      }, 1000)
    }
  },
  async asyncData({ app, params }) {
    let snippet = await app.$axios.$get(`snippets/${params.id}`);
    return {
      snippet: snippet.data,
      steps: snippet.data.steps.data
    };
  }
};
</script>

<style scoped></style>
