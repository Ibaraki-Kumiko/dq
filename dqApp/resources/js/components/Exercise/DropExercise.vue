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
                        <div class="wrapper">
                            <span>{{ index + 1 }}</span>
                            <div class="list-item2"
                                 v-html="question.question" :id="question.id">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mt-3">
                        <div @dragover.prevent
                             @drop.prevent="dropBack" class="field board mt-3" id="board-2">
                            <div v-for="(option, index) in options" v-if="!isRightAnswersShowed"
                                 class="btn float-center option-card"
                                 draggable="true" @dragover.stop :key="index" :id="`option-${index}`"
                                 @dragstart="dragStart">{{ option }}
                            </div>

                        </div>
                    </fieldset>
                    <fieldset class="mt-3 text-center">
                        <button type="button" class="btn btn-reset" @click="resetExercise" :disabled="isLoading"
                        >{{ $t("ExercisePage.resetButton") }}
                        </button>
                        <button type="button" class="btn btn-show" @click="onShowAnswers"
                                :disabled="isRightAnswersShowed || isLoading">{{ $t("ExercisePage.showAnswersButton") }}
                        </button>
                        <button type="button" class="btn btn-answer" @click="checkAnswers"
                                :disabled="isRightAnswersShowed || isLoading">{{ $t("ExercisePage.checkAnswersButton") }}
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
    name: "DropExercise",
    props: {
        exercise: Object,
    },

    components: {
        DoubleBounceLoader
    },
    data() {
        return {
            title: '',
            translation: '',
            options: [],
            questions: [],


            form: {},
            success: false,
            error: false,
            sending: false,
            errors: [],
            rightAnswers: [],
            isRightAnswersShowed: false,

            backendData: [],
            isLoading: false
        };
    },
    created() {
        this.title = this.exercise.name
        this.translation = this.exercise.translation
        this.options = this.shuffleOptions(JSON.parse(this.exercise.options[0].options))
        this.questions = this.exercise.questions

    },
    mounted() {
        const inputs = document.getElementsByClassName("answerInput")
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('dragover', this.handleDragOver);
            inputs[i].addEventListener('drop', this.handleDrop);
        }
    },
    methods: {
        shuffleOptions(obj) {
            const values = Object.values(obj);
            return values.sort(() => Math.random() - 0.5);
        },
        dragStart(event) {
            const target_id = event.target.id;
            event.dataTransfer.setData('card_id', target_id);
        },
        handleDragOver(event) {
            event.preventDefault();
        },
        handleDrop(event) {
            event.preventDefault();
            const card_id = event.dataTransfer.getData('card_id');
            const card = document.getElementById(card_id)
            card.classList.add('cardDrop')
            event.target.appendChild(card);
            this.form[event.target.parentElement.id] = card.innerText;
        },
        dropBack(e) {
            const card_id = e.dataTransfer.getData('card_id')
            const card = document.getElementById(card_id)
            card.classList.remove('cardDrop', "incorrect", "correct")
            e.target.appendChild(card);
            for (let [k, v] of Object.entries(this.form)) {
                if (v === card.innerText) {
                    delete this.form[k]
                }
            }
        },
        showCorrectAnswers() {
            const inputs = Array.from(document.getElementsByClassName("answerInput"))
            inputs.forEach((input) => {
                if (this.rightAnswers[input.parentElement.id]) {
                    input.innerHTML = this.rightAnswers[input.parentElement.id];
                    input.classList.remove('correct', 'incorrect');
                    input.classList.add('rightAnswer')
                }
            });
            this.isRightAnswersShowed = true
        },
        changeClasses() {
            const inputs = document.getElementsByClassName("answerInput")
            for (let item of inputs) {
                if (item.parentElement.id in this.errors) {
                    item.classList.add('incorrect');
                    item.classList.remove('correct');
                    if (item.childElementCount > 0) {
                        item.firstElementChild.classList.add('incorrect')
                    }
                } else {
                    item.classList.remove('incorrect');
                    item.classList.add('correct')
                    if (item.childElementCount > 0) {
                        item.firstElementChild.classList.add('correct')
                    }
                }
            }
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
        notifyParent(value) {
            this.$emit('loading-updated', value);
        },
        resetExercise() {
            this.errors = []
            this.form = {}
            const cards = Array.from(document.getElementsByClassName("option-card"))
            const inputs = Array.from(document.getElementsByClassName("answerInput"))
            const board = document.getElementById('board-2')


            cards.forEach((card) => {
                card.classList.remove('cardDrop', "correct", "incorrect")
                board.appendChild(card);
            })
            inputs.forEach((input) => {
                input.classList.remove("correct", "incorrect", "rightAnswer")
                input.innerHTML = ''

            })
            this.isRightAnswersShowed = false


        },
        onShowAnswers() {
            const exerciseId = this.$route.params.exercise_id
            const inputs = Array.from(document.getElementsByClassName("answerInput"))
            this.isLoading = true
            axios
                .get(`/answers/${exerciseId}`)
                .then(response => {
                    this.success = 201 === response.status;
                    this.rightAnswers = JSON.parse(response.data.data)
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
                .then(() => (this.isLoading = false));

        },


    }
}
</script>

<style scoped>
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 998;
}

.checkBtn {
    background-color: #04cba0;
}

.wrapper {
    /*vertical-align: middle;*/
    position: relative;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}

.list-item2 {
    display: inline;
    margin: 10px;
    padding: 10px;
    background-color: #f4f4f4;
    /*  cursor: move;*/
}


.option-card {
    /*height: 36px;
    width: fit-content;
    display: inline-block;
    margin: 4px;*/
    background-color: #e1b3006b;
    border: 1px solid #e1b300;
    margin: 1px;


}


.field {
    margin-top: 20px;
    min-height: 100px;
    background-color: #F1F3F5;
    padding: 10px;

}

.cardDrop {
    display: block;
    margin: 0;
    border: 0;
    height: 36px;
    padding-top: 6px;
    padding-bottom: 0px;
}

.incorrect {
    background-color: #de425ba3;
    border: 1px solid #de425ba3;
}

.correct {
    background-color: #8cd3926e;
    color: black;
    border: 2px solid #8cd3926e;

}


</style>


<style>


.answerInput {
    display: inline-block;
    background-color: #ffffff;
    border: 2px dotted #D1C9C2;
    height: 39px;
    width: fit-content;
    min-width: 90px;
    margin: 0 10px;
    box-sizing: border-box;
    position: absolute;
    top: -36%;

}

.rightAnswer {
    width: auto;
    background: #3C444D;
    color: #FFF;
    text-transform: none;
    font-size: 16px;
    height: 36px;
    padding: 5px 8px;
    margin-bottom: 10px;
    border-radius: 0;
    line-height: 18px;
    border: none;
}

.incorrect {
    background-color: #de425ba3;
    border: 1px solid #de425ba3;
}
</style>
