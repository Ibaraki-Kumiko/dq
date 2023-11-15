<template>
    <div class="wrapper">

        <ol>
            <li v-for="module in modules">
<!--                '/modules/:module_slug/:unit_slug/exercises/:exercise_id',-->
<!--                <router-link class="nav-link" :to="{name: 'unit', params: {slug: slug, unit_slug: unit.slug}}" :class = "{disabled: !unit.theory}">-->
<!--                <router-link class="nav-link" :to="{name: 'common', params: {module_slug: module.slug, unit_slug: module.unit.slug, exercise_id}}" :class = "{}">-->
                    {{ module.name}}
                    {{ module.translation }}

<!--               </router-link>-->


                        <ul>
                            <li v-for="unit in module.units">
                                {{unit.name}}
                                <ul>
                                    <li v-for="exercise in unit.exercises">
                                        <router-link class="nav-link" :to="{name: 'common', params: {module_slug: module.slug, unit_slug: unit.slug, exercise_id: exercise.id}}" :class = "{}">
                                        {{exercise.name}}
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>



            </li>

        </ol>

    </div>
</template>

<script>


export default {
    name: "AllExercisesPage",
    components: {


    },
    data() {
        return {
            loading: false,
            modules: [],



        }
    },
    created() {

      /*  this.slug = this.$route.params.slug;*/
        this.loading = true;
        this.$store.commit('setLoading', true);
        axios
            .get(`/exercises/`)
            .then(response => {
                this.modules = response.data.data;
                console.log(this.modules)
            })
            .then(() =>  {
                    this.$store.commit('setLoading', false);
                    this.loading = false;
                }
            );
    },



}
</script>

<style scoped>

</style>
