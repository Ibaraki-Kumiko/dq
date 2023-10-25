<template>
    <div class="wrapper">
        <h1>{{translation}}</h1>
        <ol>
            <li v-for="unit in units">
                <router-link class="nav-link" :to="{name: 'unit', params: {slug: slug, unit_slug: unit.slug}}" :class = "{disabled: !unit.theory}">
                    {{ unit.name}}
                    {{ unit.translation }}
                </router-link>
            </li>

        </ol>

    </div>
</template>

<script>
export default {
    name: "UnitsPage",
    data() {
        return {
            loading: false,
            name: '',
            translation: '',
            units: [],
            slug: ''
        }
    },
    created() {

        this.slug = this.$route.params.slug;
        this.loading = true;
        this.$store.commit('setLoading', true);
        axios
            .get(`/modules/${this.slug}`)
            .then(response => {
                this.name = response.data.data.name;
                this.translation = response.data.data.translation
                this.units = response.data.data.units
            })
            .then(() =>  {
                this.$store.commit('setLoading', false);
                this.loading = false;
            }
           );
    },
}
</script>

<style scoped lang="scss">
$font-google-primary: 'https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap';


//- @type List
$abril-fatface: 'Abril Fatface', cursive;
$heading-font-family: $abril-fatface;
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: clamp(1rem, 2vw, 3rem);
    font-family: "Open Sans", sans-serif;
    font-size: 1.1rem;
}

a {
    color: inherit;
}

.wrapper {
    max-width: 80rem;
    margin: 0 auto;
}

ol {
    padding: 1.5rem 1.5rem 1.5rem 4em;
    border: 4px solid #212529d9;;
    columns: 21rem;
    column-gap: 7rem;
    column-rule: 4px solid  #212529d9;;
    border-radius: 0;
}

ol > * + * {
    margin-top: 1rem;
}

li {
    break-inside: avoid;
    padding-left: 0.5rem;
}

::marker {
    content: counters(list-item, '') '.';
    font-family: $heading-font-family;
    font-weight: 700;
    font-size: 1rem;

    color: #dc3545;
    padding-right: 12px;
}

li span {
    display: block;
}

li span:first-child {
    font-size: 1.5em;
}

li span:last-child {
    font-style: italic;
}
.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

</style>
