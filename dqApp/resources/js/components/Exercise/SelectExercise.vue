<template>
    <div class="container mt-5">
        <h4>{{ description }}</h4>
        <h5>Select Exercise</h5>
        <div class="row">
            <form>
                <fieldset
                    class="col-12 mt-3"
                    v-for="(question, index) in questions"
                    :key="question.id"
                >

                    <div>{{ index + 1 }}.
                        <span :ref="`question${question.id}`" :id="question.id" v-html="question.question"></span>

                        <div>{{ question.translation }}</div>
                    </div>

                </fieldset>
                <fieldset class="mt-3 text-center">
                    <button type="button" class="btn btn-secondary" @click="showAnswers" :disabled="isCorrectAnswersShowed">Показать ответы</button>
                    <button type="button" class="btn btn-info float-center" @click="checkAnswers" :disabled="isCorrectAnswersShowed">Проверить ответы
                    </button>

                </fieldset>
            </form>
            <div class="col text-center">
                <button type="button" class="btn btn-success mt-5 btn-xl" >Дальше</button>
            </div>

        </div>
    </div>
</template>

<script>
import Question from "./Question";

export default {
    name: "Exercise",

    props: ['exercise'],
    components: {
        Question,
    },
    data() {
        return {
            loading: false,
            description: '',
            questions: [],
            form: {},
            success: false,
            error: false,
            sending: false,
            errors: [],
            correctAnswers: [],
            isCorrectAnswersShowed: false

        }
    },
    created() {
        this.options = this.exercise.options

        this.questions = this.exercise.questions
        this.description = this.exercise.name

        /*axios
            .get(`/exercises/1`)
            .then(response => {
                this.questions = response.data.data;
                this.description = response.data.exercises_description
            })
            .then(() => (this.loading = false));*/
    },
    methods: {
        rawHtml(question, id) {

            //  return this.$options.filters.capitalize(question, id);
        },
        showCorrectAnswers() {
            const inputs = Array.from(document.getElementsByClassName("answerInput"))
            inputs.forEach((input) => {
                console.log('correct answers' , this.correctAnswers[1])

              /*  if(input.parentElement.id in this.rightAnswers) {*/
                if(this.correctAnswers[input.parentElement.id]) {
                    //console.log('parent id', this.rightAnswers[input.parentElement.id])

                    input.value = this.correctAnswers[input.parentElement.id];

                }
                else  {
                    input.value = 'Something wrong'
                }
            });
            this.isCorrectAnswersShowed = true
        },
        changeClasses() {

            const inputs = Array.from(document.getElementsByClassName("answerInput"))
            inputs.forEach((input) => {
                if (input.parentElement.id in this.errors) {
                    input.classList.add('error');
                    input.classList.remove('success');
                }
                else  {
                    input.classList.remove('error');
                    input.classList.add('success')
                }
            });
        },
        checkAnswers() {
            this.errors = []
            //const exerciseId = this.$route.params.id
            const exerciseId = this.exercise.id
            const answers = this.form;
            //  console.info( JSON.parse(JSON.stringify(this.form)))
            // axios.post('/some/url', this.form)
            axios
                .post(`/check/${exerciseId}`, answers)
                .then(response => {
                    this.success = 201 === response.status;
                    this.errors = response.data
                    this.changeClasses()

                })
                .catch(err => {
                    //console.log(err.response.data.errors)
                    /*if (is422(err)) {
                        const errors = err.response.data.errors;
                        if (errors["content"] && 1 === _.size(errors)) {
                            this.errors = errors;
                            return;
                        }
                    }*/
                    this.error = true;
                })
                .then(() => (this.sending = false));
        },
        showAnswers() {
           // const exerciseId = this.$route.params.id
            const exerciseId = this.exercise.id

            const inputs = Array.from(document.getElementsByClassName("answerInput"))
            inputs.forEach((input) => {
                    input.classList.remove('success', 'error');
                    input.classList.add('rightAnswer')

            });
            axios
                .get(`/answers/${exerciseId}`)
                .then(response => {
                    this.success = 201 === response.status;

                    this.correctAnswers = JSON.parse(response.data.data)

                    this.showCorrectAnswers();


                })
                .catch(err => {
                    //console.log(err.response.data.errors)
                    /*if (is422(err)) {
                        const errors = err.response.data.errors;
                        if (errors["content"] && 1 === _.size(errors)) {
                            this.errors = errors;
                            return;
                        }
                    }*/
                    this.error = true;
                })
                .then(() => (this.sending = false));

        },
        spanClasses(id) {

            if (id in this.errors) {

                return "text-white bg-danger";
            }

            /*return this.day.id === Store.getters.activeDay().id
                ? ["border-primary"]
                : null;*/
        },
    },

    filters: {
        capitalize: function (value, id) {
//:class="spanClasses(question.id)"
            return value.replace(
                '####',
                ` <input type = "text" class="some"  id="${id}"></input>`
            );
        }
    },
    mounted() {

        /*   this.$refs.addEventListener('click', function(event) {
                event.preventDefault();
                console.log('clicked: ', event.target);
            })*/
/*
        const interval = setInterval(() => {
            if (this.$refs.question1) {
                const inputs = this.$el.querySelectorAll('.answerInput')
                inputs.forEach((input) => {
                    input.addEventListener('blur', (e) => {
                        e.preventDefault();
                        console.log('target', e.target.parentElement)
                        this.form[e.target.parentElement.id] = e.target.value;
                    })
                })
                clearInterval(interval)
            }
        }, 50)*/
    }




    /*  spans.forEach((span) => {
          span.addEventListener('click', (e) => {
               e.preventDefault();
               console.log('clicked: ', e.target);
           });
       });*/


}
</script>

<style scoped>
/*.answerInput {
    background-color: #fff;
    border: 2px dotted #D1C9C2;
    height: 30px;
    width: 80px

}

.error {
    background-color: #ef6868;
    border: 2px solid #D1C9C2;
}

.success {
    background-color: #20911e;
    color: white;
    border: 2px solid #D1C9C2;
}

.rightAnswer {
   !* width: auto;*!
    background: #3C444D;
    color: #FFF;
    text-transform: none;
    font-size: 16px;
    height: 30px;
    padding: 5px 8px;
    margin-bottom: 10px;
    border-radius: 0;
    line-height: 18px;
    border: none;
}

.btn-xl {
    padding: 10px 20px;
    font-size: 20px;
    border-radius: 10px;
    width:50%
}*/
</style>
