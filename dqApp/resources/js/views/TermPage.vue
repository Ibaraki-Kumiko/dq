<template>
    <div>
        <EllipsisLoader :color="'#54f1d2'" :loading="isLoading"></EllipsisLoader>
        <div v-show="!isLoading">
            <Breadcrumbs/>

            <div class="term">
                <h1 class="term__title">{{ this.term }}</h1>
            </div>
            <p>{{ this.type }}</p>
            <!--        <p>Lautschrift </p>-->
            <div>
                <h2>Значения</h2>
                <p>{{ this.definition }}</p>
                <dl class="note">
                    <dt class="note__title">Примеры</dt>
                    <dd>
                        <ul class="note__list">
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam</li>
                        </ul>
                    </dd>
                </dl>

            </div>
        </div>
    </div>
</template>

<script>
import Breadcrumbs from '../components/shared/Breadcrumbs';
import EllipsisLoader from "../components/shared/EllipsisLoader";

export default {
    name: "TermPage",
    components: {
        Breadcrumbs,
        EllipsisLoader
    },
    data() {
        return {
            isLoading: false,
            term: '',
            translation: '',
            definition: '',
            type: '',
            units: []
        }
    },
    props: {},
    created() {
        const slug = this.$route.params.slug
        this.isLoading = true;
        axios
            .get(`/dictionary/${slug}`)
            .then(response => {
                this.term = response.data.data.term;
                this.translation = response.data.data.translation
                this.type = response.data.data.type
                this.definition = response.data.data.definition
            })
            .then(() => (this.isLoading = false));
    },


}
</script>

<style scoped>
.term {
    margin: 10px 0 0.5em;
}

.term__title {
    font-size: 38px;
    display: inline-block;
    vertical-align: baseline;
    margin: 0;
    font-family: T, cv-linear, l, sans-serif;
    line-height: 45px;
    font-weight: 700;
}

.note {
    background: #a0ebda;
    padding: 20px;
    margin: 1em 0;
    outline: #a0ebda solid 5px;
    font-family: T, cv-linear, l, sans-serif;
}

dl {
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}
</style>
