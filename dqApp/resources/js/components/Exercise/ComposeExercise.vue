<template>
    <div class="container">
        <double-bounce-loader :background="'#04cba0'" v-show="isLoading"></double-bounce-loader>

        <div class="mt-5">

            <h3>{{ title }}</h3>
            <h4>{{ translation }}</h4>

            <div class="row">
                <form>
                    <fieldset
                        class="col-12 mt-5"
                        v-for="(question, index)  in questions" :key="index">
                        <span>{{ index + 1 }}. </span>
                        <span class="question_translation-text">{{ question.translation }}</span>

                        <input :id="index + 1" type="text" class="userAnswer bottom-border-input"
                               v-model="form[index + 1]" :class="getClasses(index + 1)">
                        <div class="question-text text-muted">{{ question.question }}</div>
                    </fieldset>

                    <fieldset class="mt-3 text-center">
                        <button type="button" class="btn btn-reset" @click="resetExercise" :disabled="isLoading"
                        >Сбросить
                        </button>
                        <button type="button" class="btn btn-show" @click="showAnswers"
                                :disabled="isCorrectAnswersShowed || isLoading">Показать ответы
                        </button>
                        <button type="button" class="btn btn-answer" @click="checkAnswers"
                                :disabled="isCorrectAnswersShowed || isLoading">Проверить ответы
                        </button>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import DoubleBounceLoader from "../shared/DoubleBounceLoader";

export default {
    name: "ComposeExercise",
    data() {
        return {
            title: '',
            translation: '',

            questions: [],
            description: '',

            form: [],
            errors: [],
            correctAnswers: [],
            isCorrectAnswersShowed: false,
            isAnswersChecked: false,

            isLoading: false
        }
    },
    props: {
        exercise: Object,
    },
    components: {
        DoubleBounceLoader
    },
    created() {
        this.title = this.exercise.name
        this.translation = this.exercise.translation
        this.questions = this.exercise.questions
    },

    methods: {
        getClasses(id) {
            if (this.isAnswersChecked) {
                return id in this.errors ? {incorrect: true} : {success: true}
            } else if (this.isCorrectAnswersShowed) {
                return {rightAnswer2: true, incorrect: false, success: false}
            }
            else {
                return {incorrect: false, success: false, rightAnswer2: false}
            }

        },

        showAnswers() {
            const exerciseId = this.$route.params.exercise_id
            this.isLoading = true
            axios
                .get(`/answers/${exerciseId}`)
                .then(response => {
                    this.success = 201 === response.status;
                    this.correctAnswers = JSON.parse(response.data.data)
                    this.form = this.correctAnswers
                    this.isAnswersChecked = false
                    this.isCorrectAnswersShowed = true
                })
                .catch(err => {
                    this.error = true;
                })
                .then(() => (this.isLoading = false));
        },

        resetExercise() {
            this.errors = []
            this.form = {}
            this.isAnswersChecked = false
            this.isCorrectAnswersShowed = false
        },
        checkAnswers() {
            this.errors = []
            this.isAnswersChecked = false

            const exerciseId = this.$route.params.exercise_id
            const answers = this.form;

            this.isLoading = true
            axios
                .post(`/check/${exerciseId}`, answers)
                .then(response => {
                    this.success = 201 === response.status;
                    this.errors = response.data
                    this.isAnswersChecked = true
                })
                .catch(err => {
                    this.error = true;
                })
                .then(() => (this.isLoading = false));
        },

    },
}
</script>

<style scoped>
.userAnswer {
    margin-left: 20px;
    display: block;
    width: 50%;
    background-color: #f8fafc;


}

.bottom-border-input {
    border: none;
    border-bottom: 2px solid #656565;
    outline: none;
}

.question-text {
    margin-left: 24px;
}

.question_translation-text {
    margin-left: 5px
}

.rightAnswer2 {
    background-color: #3C444D;
    border: 1px dotted #3C444D;
    color: #FFF;
}

.incorrect {
    background-color: #de425ba3;
    border: 1px solid #de425ba3;
}


.success {
    background-color: #8cd3926e;
    color: black;
    /*  border: 2px solid #8cd3926e;*/
    /*  #13a011*/
}
.btn-answer {
    background-color: #04cba087;
    transition: background-color 0.3s;
}

.btn-answer:hover {
    background-color: #04cba0;
}

.btn-reset, .btn-show {
    background-color: #ffa60066;
    transition: background-color 0.3s;
}

.btn-reset:hover, .btn-show:hover {
    background-color: #ffa600;
}
</style>
