<template>
    <div class="app-wrapper">
        <div class="container">
            <top-nav-bar></top-nav-bar>
            <div class="row">
                <sidebar @changeComponent="handleChangeComponent" class="col-2">
                </sidebar>
                <component :is="DynamicComponent" class="col-10">
                </component>

            </div>
        </div>


        <!--        <content-footer v-if="!$route.meta.hideFooter"></content-footer>-->

    </div>
</template>

<script>
import TopNavBar from "../../components/admin/TopNavBar";
import Sidebar from "../../components/admin/Sidebar"

const DashboardContent = () => import("../../components/admin/DashboardContent");
const Permissions = () => import("../../components/admin/Permissions");
export default {
    name: "layout",
    components: {
        TopNavBar,
        Sidebar,

    },
    data() {
        return {
            type: null,
        };
    },
    computed: {
        DynamicComponent() {
            if (this.type === null) return DashboardContent;
            return () => import(`../../components/admin/${this.type}`)

        }
    },
    methods: {
        handleChangeComponent(type) {
            this.type = type;

        }
    }
}
</script>

<style scoped>

</style>
