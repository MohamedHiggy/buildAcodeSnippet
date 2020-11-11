import { orderBy as _orderBy } from "lodash";
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
}