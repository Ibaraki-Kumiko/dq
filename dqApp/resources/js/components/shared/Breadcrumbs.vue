<template>
    <div class="breadcrumbs">
        <span> <router-link to="/"> Home</router-link></span>
        <span> > </span>
        <span v-for="(crumb, index) in crumbs" :key="index">
      <router-link v-if="index !== crumbs.length - 1" :to="crumb.path">{{ crumb.text }}</router-link>
      <span v-else>{{ crumb.text }}</span>
      <span v-if="index !== crumbs.length - 1"> > </span>
    </span>
    </div>
</template>

<script>
export default {
    name: "Breadcrumbs",
    data() {
        return {
            crumbs: [],
        };
    },
    watch: {
        $route(to) {
            this.generateCrumbs(to);
        },
    },
    mounted() {
        this.generateCrumbs(this.$route);
        console.log("$router", this.$router.options.routes);
        console.warn("$route", this.$route);
    },
    methods: {
        replaceHyphensWithSpaces(inputString) {
            return inputString.replace(/-/g, ' ');
        },
        generateCrumbs(route) {
            const segments = route.path.split('/').filter(segment => segment);
            console.log(segments)
            this.crumbs = segments.map((segment, index) => {
                return {
                    text: this.replaceHyphensWithSpaces(segment),
                    path: `/${segments.slice(0, index + 1).join('/')}`,
                };
            });
        },
    },
}
</script>

<style scoped>
.breadcrumbs {
    font-size: 14px;
    line-height: 15px;
    letter-spacing: .2px;
    margin: 1em 0;
    font-family: Px, cv-linear, l, monospace;
    text-decoration: none;
}
.breadcrumbs a:hover {
   /* text-decoration: underline;*/
    font-weight: bold;
}
</style>
