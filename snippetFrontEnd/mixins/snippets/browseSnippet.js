import { orderBy as _orderBy } from "lodash";
import hotkeys from "hotkeys-js";
export default {
    computed: {
        //built in nuxt to create filter of order
        orderedStepsAsc() {
            return _orderBy(this.steps, "order", "asc");
        },
        orderedStepsDesc() {
            return _orderBy(this.steps, "order", "desc");
        },
        firstStep() {
            return this.orderedStepsAsc[0];
        },
        currentStep() {
            return this.orderedStepsAsc.find((e) => e.uuid === this.$route.query.step) || this.firstStep
        },
        nextStep() {
            return this.orderedStepsAsc.find((e) => e.order > this.currentStep.order) || null
        },
        prevStep() {
            return this.orderedStepsDesc.find((e) => e.order < this.currentStep.order) || null
        },
        currentStepIndex() {
            return this.orderedStepsAsc.map((e) => e.uuid).indexOf(this.currentStep.uuid)
        },
    },
    mounted() {
        this.keyboardShortcuts();
    },
    methods: {

        goToStep(step) {
            this.$router.push({
                query: {
                    step: step.uuid
                }
            })
        },
        keyboardShortcuts() {
            hotkeys('ctrl+shift+left, ctrl+shift+right', (event, handler) => {
                switch (handler.key) {
                    case 'ctrl+shift+left':
                        if (this.prevStep) {
                            this.goToStep(this.prevStep)
                        }
                        break;
                    case 'ctrl+shift+right':
                        if (this.nextStep) {
                            this.goToStep(this.nextStep)
                        }
                        break;
                }
            })
        }
    },
}