<template>
    <div>Question {{ question.id }}
        <div><span v-html="rawHtml(question.question)"></span></div>
        <div>{{ question.translation }}</div>
    </div>

</template>

<script>
export default {
    name: "Question",
     data() {
             return {

             }
         },
    props: {
        question: Object,
    },
    methods: {
        rawHtml(question) {
            return this.$options.filters.capitalize(question);
        }
    },
    mounted() {
    },
    filters: {
        capitalize: function (value,) {
            return value.replace(
                '####',
                ` <input type = "text" style="color:red;" </input>`
            );
        }
    }
}
</script>

<style scoped>

</style>
