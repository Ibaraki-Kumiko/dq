<template>
     <select v-model="$i18n.locale" class="form-select locale-changer">
            <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">
                {{ lang }}
            </option>
        </select>
</template>

<script>
export default {
    name: "SwitchLanguage",
    data() {
        return { langs: ['ru', 'de'] }
    },
    methods: {
        switchLanguage(language) {
           this.$store.dispatch('changeLanguage', language);
        }
    }
}
</script>

<style scoped>
.locale-changer {
    border: none;
   /* margin-top: 5px;*/
}
</style>
