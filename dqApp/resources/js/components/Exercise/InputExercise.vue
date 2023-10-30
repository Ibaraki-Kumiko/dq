<template>
    <div class="container">
        <double-bounce-loader :background="'#04cba0'" v-show="isLoading"></double-bounce-loader>

        <div class="mt-5">

            <h3>{{ title }}</h3>
            <h4>{{ translation }}</h4>

            <div class="row">
                <form>
                    <fieldset
                        class="col-12 mt-4"
                        v-for="(question, index)  in questions" :key="index"
                    >
                        <span>{{ index + 1 }}. </span>
                        <span
                            v-html="question.question" :id="question.id" v-on:input="onAnswerInput">
                            </span>
                        <div class="question_translation">{{ question.translation }}</div>

                    </fieldset>

                    <fieldset class="mt-3 text-center">
                        <button type="button" class="btn btn-reset" @click="resetExercise" :disabled=" isLoading"
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
    name: "InputExercise",

    data() {
        return {
            testForm: [],
            questions: [],
            description: '',
            form: {},
            success: false,
            error: false,
            sending: false,
            errors: [],
            correctAnswers: [],
            isCorrectAnswersShowed: false,
            title: '',
            translation: '',
            backendData: [],
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
        this.options = JSON.parse(this.exercise.options[0].options)
        this.questions = this.exercise.questions
    },
    mounted() {
    },
    methods: {
        onAnswerInput(e) {
            this.form[e.target.parentElement.id] = e.target.value;
        },
        showAnswers() {
            const exerciseId = this.$route.params.exercise_id
            axios
                .get(`/answers/${exerciseId}`)
                .then(response => {
                    this.success = 201 === response.status;
                    this.correctAnswers = JSON.parse(response.data.data)
                    this.showCorrectAnswers();
                })
                .catch(err => {

                    this.error = true;
                })
                .then(() => (this.sending = false));

        },
        showCorrectAnswers() {
            const inputs = Array.from(document.getElementsByClassName("userAnswer"))
            inputs.forEach((input) => {
                if (this.correctAnswers[input.parentElement.id]) {
                    input.value = this.correctAnswers[input.parentElement.id];
                    input.classList.remove('success', 'incorrect');
                    input.classList.add('rightAnswer3')

                } else {
                    input.innerHTML = 'Something wrong'
                }
            });
            this.isCorrectAnswersShowed = true
        },
        resetExercise() {
            this.errors = []
            this.form = {}
            const inputs = Array.from(document.getElementsByClassName("userAnswer"))

            inputs.forEach((input) => {
                input.classList.remove("success", "incorrect", "rightAnswer3")
                input.value = ''
            })
            this.isCorrectAnswersShowed = false


        },
        checkAnswers() {
            this.errors = []
            this.backendData = []
            const exerciseId = this.$route.params.exercise_id
            const answers = this.form;
            this.isLoading = true
            axios
                .post(`/check/${exerciseId}`, answers)
                .then(response => {
                    this.success = 201 === response.status;
                    this.errors = response.data
                    this.backendData = response.data
                    this.changeClasses()
                })
                .catch(err => {
                    this.error = true;
                })
                .then(() => (this.isLoading = false));
        },
        changeClasses() {
            const inputs = document.getElementsByClassName("userAnswer")
            for (let item of inputs) {
                if (item.parentElement.id in this.errors) {
                    item.classList.add('incorrect');
                    item.classList.remove('success');
                    if (item.childElementCount > 0) {
                        item.firstElementChild.classList.add('incorrect')
                    }
                } else {
                    item.classList.remove('incorrect');
                    item.classList.add('success')
                    if (item.childElementCount > 0) {
                        item.firstElementChild.classList.add('success')
                    }
                }
            }
        }


    },
}
</script>

<style>
.userAnswer {
    background-color: #ffffff;
    border: 2px dotted #D1C9C2;
    width: 90px;
    margin: 0 10px;
    box-sizing: border-box;
}

.question_translation {
    margin-left: 20px;
}

.checkBtn {
    background-color: #04cba0;
}

.rightAnswer3{
    text-align: center;
    background-color: #3C444D;
    border: 2px dotted #3C444D;
    color: #FFF;
    width: 90px;
    margin: 0 10px;
    box-sizing: border-box;
}

.incorrect {
    background-color: #de425ba3;
    border: 1px solid #de425ba3;
}


.success {
    background-color: #8cd3926e;
    color: black;
    border: 2px solid #8cd3926e;
}
</style>
