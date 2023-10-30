<template>
    <div class="container">
        <div class="content">
            <Toast />
            <EllipsisLoader :color="'#54f1d2'" :loading="loading"></EllipsisLoader>
            <!-- <template v-if="isAdmin">
                 <admin-menu></admin-menu>
             </template>-->
<!--            <template v-if="!isAdmin">
                <TopMenu></TopMenu>
            </template>-->
            <template>
                <TopMenu></TopMenu>
            </template>
            <router-view v-show="!loading"></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
import TopMenu from "./components/shared/TopMenu";
import Footer from "./components/shared/Footer";
import EllipsisLoader from "./components/shared/EllipsisLoader";
import {mapState, mapGetters} from 'vuex'
import {actionTypes as authGetterTypes} from './store/modules/auth'

import Toast from 'primevue/toast';


export default {
    name: "index",
    components: {
        TopMenu,
        Footer,
        Toast,
        EllipsisLoader

    },
    computed: {
        toastMessage() {
            return this.$store.state.toast.toastMessage;
        },

            loading() {
                return this.$store.state.loading;
            }
    },

    watch: {
        toastMessage(newMessage) {
            if (newMessage) {
                this.$toast.add({
                    severity: 'success',
                    summary: 'Успех',
                    detail: newMessage,
                    life: 3000,
                });
            }
        },
    },
  /*  computed: {
        ...mapState({
            /!* isLoading: state => state.userProfile.isLoading,
             error: state => state.userProfile.error*!/
        }),
        ...mapGetters({
            /!*   currentUser: authGetterTypes.currentUser,
               isAdmin: 'isAdmin'*!/


        }),
        userProfileSlug() {
            return this.currentUser.nickname
        },
    },*/
    created() {


    },
    mounted() {

    },

}
</script>

<style scoped>
.content {
    min-height: calc(100vh - 191px);
}

</style>
