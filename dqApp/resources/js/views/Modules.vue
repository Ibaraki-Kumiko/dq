<template>
    <div class="container">
        <div class="row">
            <h2>Модули</h2>
            <div v-for="module in modules">
                <h5>{{ module.translation }}</h5>
                <router-link class="nav-link" :to="{name: 'module', params: {id: module.id}}">{{ module.translation }}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modules",
    data() {
        return {
            loading: false,
            description: '',
            modules: [],
        }
    },
    created() {
        this.loading = true;
        axios
            .get(`/modules`)
            .then(response => {
                this.modules = response.data.data;
            })
            .then(() => (this.loading = false));
    },

}
</script>

<style scoped>

</style>
