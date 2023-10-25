<template>
    <div>
        <strong>Упражнения</strong>

        <ol class="alternating-colors">
            <li v-for="exercise in exercises">
                <a @click="handleClick(exercise, $event)" class="exercise_link">
                    <strong class="exercise_title"> {{ exercise.name }}</strong>
                    <span> {{ exercise.translation }}</span>
                </a>
            </li>
        </ol>
    </div>
</template>

<script>
export default {
    name: "ExercisesPage",
    data() {
        return {
            loading: false,
            exercises: [],
            success: false,
            error: false,
            moduleId: '',
            unitId: '',
            module_slug: '',
            unit_slug: ''
        }
    },
    methods: {
        handleClick(exercise, event) {
            this.$router.push({
                path: `/modules/${this.module_slug}/${this.unit_slug}/exercises/${exercise.id}`,
                params: {unit_id: this.module_slug, id: this.unit_slug, exercise_id: exercise.id}
            })
        }
    },
    created() {
        this.slug = this.$route.params.unit_slug;
        this.loading = true;
        this.$store.commit('setLoading', true);
        this.module_slug = this.$route.params.slug
        this.unit_slug = this.$route.params.unit_slug

        axios
            .get(`/exercises/${this.slug}`)
            .then(response => {
                this.exercises = response.data
            })
            .then(() => {
                this.$store.commit('setLoading', false);
                this.loading = false
            });

    },
}
</script>

<style scoped lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');

ol {
    padding-left: 50px;
}

li {
    color: #4F4F4F;
    padding-left: 16px;
    margin-top: 24px;
    position: relative;
    font-size: 16px;
    line-height: 20px;

    &:before {
        content: '';
        display: block;
        height: 42px;
        width: 42px;
        border-radius: 50%;
        border: 2px solid #ddd;
        position: absolute;
        top: -12px;
        left: -33px;
    }

    &::marker {

    }
}

.exercise_title {
    display: block;
}

strong {
    color: #292929;
}

ol.alternating-colors {

    li:nth-child(odd):before {
        border-color: #de425b;
    }

    li:nth-child(even):before {
        border-color: #de425b;
    }
}

.exercise_link {
    cursor: pointer;
}
</style>
