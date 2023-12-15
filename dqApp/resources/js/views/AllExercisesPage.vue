<template>
    <div class="row">
        <div class="wrapper">
            <ol>
                <li v-for="module in modules">
                    <h6>{{ module.name }}</h6>
                    <div v-for="(unit, index) in module.units" :key="index">
                        <div v-if="unit.exercises.length > 0">
                            <div>{{ unit.name }}  </div>
                                <ol class="col-6">
                                    <li v-for="exercise in unit.exercises">
                                        <router-link class="link"
                                                     :to="{name: 'common', params: {module_slug: module.slug, unit_slug: unit.slug, exercise_id: exercise.id}}"
                                                    >
                                            {{ exercise.name }}
                                        </router-link>
                                    </li>
                                </ol>
                        </div>
                    </div>
                </li>

            </ol>
        </div>


    </div>
</template>

<script>


export default {
    name: "AllExercisesPage",
    components: {},
    data() {
        return {
            loading: false,
            modules: [],
        }
    },
    created() {

        this.loading = true;
        this.$store.commit('setLoading', true);
        axios
            .get(`/exercises/`)
            .then(response => {
                this.modules = response.data.data;
                console.log(this.modules)
            })
            .then(() => {
                    this.$store.commit('setLoading', false);
                    this.loading = false;
                }
            );
    },


}
</script>

<style scoped>
.link {
    text-decoration: underline;
    color: #0545a1;
}
</style>
