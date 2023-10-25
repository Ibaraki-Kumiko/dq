<template>
    <div>
        <EllipsisLoader :color="'#54f1d2'" :loading="isLoading"></EllipsisLoader>
        <component :is="dynamicComponent" :exercise="this.exercise" v-show="!isLoading" @loading-updated="updateLoading"></component>
    </div>

</template>

<script>
import EllipsisLoader from "../components/shared/EllipsisLoader";
import DropExersice from "../components/Exercise/DropExercise";
import SelectExercise from "../components/Exercise/SelectExercise";
import InputExercise from "../components/Exercise/InputExercise";
import ComposeExercise from "../components/Exercise/ComposeExercise";


export default {
    name: "Exercise",
    components: {
        DropExersice,
        SelectExercise,
        ComposeExercise,

        EllipsisLoader
    },
    computed: {
        dynamicComponent() {
            if(this.exerciseType === "drop") {
                return DropExersice;
            }else if (this.exerciseType === "select"){
                return SelectExercise;
            }
            else if (this.exerciseType === "input"){
                return InputExercise;
            }
            else if (this.exerciseType === "compose"){
                return ComposeExercise;
            }
            else {
                return SelectExercise
            }

        }
    },
    data() {
        return {
            isLoading: false,
            exerciseType: '',
            questions: [],
            options: [],
            description: '',
            exercise: {}

        }
    },
    created() {
        this.isLoading = true;
        const exerciseId = this.$route.params.exercise_id
        axios
            .get(`/exercise/${exerciseId}`)
            .then(response => {
                this.exerciseType = response.data.type
                this.questions = response.data.question;
                this.exercise = response.data
                this.options = JSON.parse(response.data.options[0].options)
            })
            .then(() => (this.isLoading = false));


    },
    methods: {
        updateLoading(value) {
            this.isLoading = value;
        }
    }
}
</script>

<style scoped>

</style>
