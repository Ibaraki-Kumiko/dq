<template>
    <div class="container">
        <div class="row">
            <div>
                <Breadcrumbs/>
            </div>
            <theory-page></theory-page>
        </div>
    </div>
</template>

<script>
import TheoryPage from "./TheoryPage";
import Breadcrumbs from '../components/shared/Breadcrumbs';

export default {
    name: "UnitPage",
    data() {
        return {
            loading: false,
            title: '',
            description: '',
            content: '',
        }
    },
    components: {
        Breadcrumbs,
      TheoryPage
    },
    created() {
        const module_slug =  this.$route.params.slug
        const unit_slug =  this.$route.params.unit_slug

        this.loading = true;
        axios
            .get(`/modules/${module_slug}/${unit_slug}`)
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
