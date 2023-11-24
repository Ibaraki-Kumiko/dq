<template>
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{ this.$i18n.locale }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li v-for="(lang, i) in langs" :key="`Lang${i}`">
                <a class="dropdown-item" href="#" @click="changeLanguage(lang)">{{ lang }}</a>
            </li>
        </ul>
    </div>
</template>

<script>

export default {
    name: "SwitchLanguage",
    data() {
        return {
            langs: ['ru', 'de'],
        }
    },
    methods: {
       /* switchLanguage(language) {
           this.$store.dispatch('changeLanguage', language);
        },*/
        changeLanguage(langKey) {
            this.$i18n.locale = langKey;
        },

    },

}
</script>



<style scoped>
.dropdown-item:focus, .dropdown-item:hover {
    color: #1e2125;
    background-color: #e9ecef;
}

</style>
