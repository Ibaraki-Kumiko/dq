<template>
    <div>
        <h1>{{ this.translation }}</h1>
        <div class="col-12">
            <div v-for="unit in units">
                <router-link class="nav-link" :to="{name: 'unit', params: {unit_id: unit.id}}">{{ unit.translation }}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModulePage",
    data() {
        return {
            loading: false,
            name: '',
            translation: '',
            units: []
        }
    },
    props: {},
    components: {},

    created() {
        const moduleId = this.$route.params.id
        this.$store.commit('setLoading', true);
        this.loading = true;
        axios
            .get(`/modules/${moduleId}`)
            .then(response => {
                this.name = response.data.data.name;
                this.translation = response.data.data.translation
                this.units = response.data.data.units
            })
            .catch(error => {
                console.log("Зашел в блок catch")
            if (error.response) {

                console.log('Ошибка:', error.response.status);
                console.log('Данные ошибки:', error.response.data);
            } else if (error.request) {

                console.log('Нет ответа от сервера:', error.request);
            } else {
                // Что-то случилось при настройке запроса
                console.log('Ошибка:', error.message);
            }
            console.log('Ошибка конфигурации:', error.config)

        })
            .then(() => {
                this.$store.commit('setLoading', false);
                (this.loading = false)
            }
        )
    },
}
</script>

<style scoped>

</style>
