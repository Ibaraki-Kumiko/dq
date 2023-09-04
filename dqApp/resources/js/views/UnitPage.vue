<template>
    <div class="container">
        <div class="row">
            <div>
                <h4>{{ this.title}}</h4>
                <div>{{ this.description}}</div>
              <div>{{ this.content}}</div>

            </div>
        </div>
    </div>
</template>

<script>
//import TheoryPage from "./TheoryPage";

export default {
    name: "UnitPage",
 /*   props: {
        unit: Object
    }*/
    data() {
        return {
            loading: false,
            title: '',
            description: '',
            content: '',
        }
    },
    components: {
       // TheoryPage
    },
    created() {
        const unitId = this.$route.params.unit_id
        const moduleId = this.$route.params.id
        this.loading = true;
        axios
            .get(`/modules/${moduleId}/${unitId}`)
            .then(response => {
               this.title = response.data.data.title;
                this.content = response.data.data.content
                this.description = response.data.data.description

            })
            .then(() => (this.loading = false));
    },
}
</script>

<style scoped>

</style>
