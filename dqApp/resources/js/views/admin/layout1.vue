<template>
    <div class="admin-panel">
        <sidebar class="sidebar" :class="{ 'sidebar-open': isSidebarOpen }"  @changeComponent="handleChangeComponent" ></sidebar>
        <div class="main-content" :class="{ 'main-content-expanded': isSidebarOpen }">

            <admin-menu></admin-menu>
            <component :is="DynamicComponent" class="col-10">
            </component>
<!--            <button @click="toggleSidebar" class="hamburger-button">&#9776;</button>-->
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/admin/Sidebar"
import AdminMenu from "../../components/admin/TopNavBar";
//const Permissions = () => import("../../components/admin/Permissions");
const DashboardContent = () => import("../../components/admin/DashboardContent");
//const Modules = () => import("../admin/modules/index");
export default {
    data() {
        return {
            isSidebarOpen: false,
            type: null,
        };
    },
    components: {
        Sidebar,
        AdminMenu
    },
    computed: {
        DynamicComponent() {
            if (this.type === null) return DashboardContent;
            return () => import(`../../components/admin/${this.type}`)

        }
    },
    methods: {
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen;
        },
        handleChangeComponent(type) {
            this.type = type;

        }
    },
};
</script>

<style scoped>
.admin-panel {
    display: flex;
    height: 100vh;
    overflow: hidden;
  /*  background-color: bisque;*/
}

.sidebar {
    width: 200px;
    height: 100%;
  /*  background-color: #333;
    color: white;*/
    transition: transform 0.3s ease-in-out;
}

.sidebar-open {
    /*//transform: translateX(0);*/
    width: 50px;
}

.main-content {
    flex: 1;
    overflow: auto;
    transition: width 0.3s ease-in-out;
}

.main-content-expanded {
    /*margin-left: 250px; *//* Учитывайте ширину сайдбара при расширении */
}

.hamburger-button {
    position: fixed;
    top: 10px;
    left: 10px;
    z-index: 1;
    cursor: pointer;
    background: none;
    border: none;
    font-size: 24px;
    color: #333;
}
</style>
