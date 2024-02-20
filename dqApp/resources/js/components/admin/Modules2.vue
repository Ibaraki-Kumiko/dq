<template>
    <div class="container">
        <div class="row">
            <h2>Модули</h2>
            <template v-for="(module, index) in modules">
                <div :key="module.id">
                    <h5>{{module.translation }}</h5>
                    <SpeedDial :model="items" :key="Modules"/>
                    <router-link class="nav-link" :to="{name: 'module', params: {id: module.id}}">{{module.translation }}
                    </router-link>
                </div>

            </template>

        </div>
    </div>
</template>

<script>
import SpeedDial from 'primevue/speeddial';
export default {
    name: "index",
    data() {
        return {
            loading: false,
            description: '',
            modules: [],
            items: [
                {
                    label: 'Add',
                    icon: 'pi pi-pencil',
                    command: () => {
                        this.$toast.add({ severity: 'info', summary: 'Add', detail: 'Data Added' });
                    }
                },
                {
                    label: 'Update',
                    icon: 'pi pi-refresh',
                    command: () => {
                        this.$toast.add({ severity: 'success', summary: 'Update', detail: 'Data Updated' });
                    }
                },
                {
                    label: 'Delete',
                    icon: 'pi pi-trash',
                    command: () => {
                        this.$toast.add({ severity: 'error', summary: 'Delete', detail: 'Data Deleted' });
                    }
                },

            ]
        }
    },
    components: {
        SpeedDial
    },
    created() {
        this.loading = true;
        axios
            .get(`admin/modules`)
            .then(response => {

                this.modules = response.data.data;
                //this.description = response.data.exercises_description
            })
            .then(() => (this.loading = false));
    },
}
</script>

<style scoped>

</style>
