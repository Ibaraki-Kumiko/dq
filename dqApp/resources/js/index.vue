<template>
    <div class="container">
        <div class="content">
            <!-- <template v-if="isAdmin">
                 <admin-menu></admin-menu>
             </template>-->
            <template v-if="!isAdmin">
                <TopMenu></TopMenu>
            </template>
            <router-view></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
import TopMenu from "./components/shared/TopMenu";
import Footer from "./components/shared/Footer";
import {mapState, mapGetters} from 'vuex'
import {actionTypes as authGetterTypes} from './store/modules/auth'

export default {
    name: "index",
    components: {
        TopMenu,
        Footer
    },
    computed: {
        ...mapState({
            /* isLoading: state => state.userProfile.isLoading,
             error: state => state.userProfile.error*/
        }),
        ...mapGetters({
            /*   currentUser: authGetterTypes.currentUser,
               isAdmin: 'isAdmin'*/


        }),
        userProfileSlug() {
            return this.currentUser.nickname
        },
    },

    mounted() {
        /* console.log('current user for menu', this.$store.getters.isAdmin, this.isAdmin);*/
    }
}
</script>

<style scoped>
.content {
    min-height: calc(100vh - 191px);
}

</style>
