<template>
    <nav class="nav top-nav mb-5 border-bottom d-flex">

        <router-link class="navbar-brand-link" to="/">
            <div class="navbar-brand">Deutsche Quelle</div>
        </router-link>

        <ul class="nav">
            <li class="nav-item">
                <router-link class="nav-link" :to="{name: 'home'}" exact active-class="active">
                    {{ $t("TopMenu.home") }}
                </router-link>
            </li>
        </ul>
        <template v-if="isLoggedIn">
            <ul class="nav">
<!--                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'favorites'}" exact active-class="active">Избранное
                    </router-link>
                </li>-->
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'modules'}" exact active-class="active">{{ $t("TopMenu.grammar") }}
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'dictionary'}" exact active-class="active">{{ $t("TopMenu.dictionary") }}
                    </router-link>
                </li>
            </ul>

            <ul class="nav margin-left">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <RiAccountCircleLine></RiAccountCircleLine>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li>
                            <router-link class="nav-link"
                                         :to="{name: 'profile', params: {nickname: currentUser.nickname}}"
                                         :key="currentUser.id" active-class="active">
                                <!--                                    <img :src="profile.thumbnail" class="prev-pic" alt="">-->
                                <div>
                                    <span>{{ currentUser.nickname }}</span>
                                    <span class="text-muted">{{ currentUser.email }}</span>
                                </div>
                            </router-link>
                            <hr class="menu-divider">
                        </li>
                        <li>
                            <router-link class="nav-link"
                                         :to="{name: 'updateProfile', params: {nickname: currentUser.nickname}}"
                                         active-class="active">
                                {{ $t("TopMenu.settings") }}
                            </router-link>
                            <hr class="menu-divider">
                        </li>

                        <li><a class="dropdown-item" href="#" @click.prevent="onClick">{{ $t("TopMenu.logout") }}</a></li>
                    </ul>
                </li>
                <li>
                    <switch-language></switch-language>
                </li>
            </ul>


        </template>

        <template v-if="isAnonymous">
            <ul class="nav margin-left">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'login'}" active-class="active">{{ $t("TopMenu.signIn") }}</router-link>
                </li>

                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'register'}" active-class="active">{{ $t("TopMenu.signUp") }}</router-link>
                </li>
                <li class="nav-item">
                    <switch-language></switch-language>
                </li>
            </ul>
        </template>

    </nav>
</template>

<script>
import {actionTypes, getterTypes} from "../../store/modules/auth";
import {mapGetters, mapState} from "vuex";
import {
    RiAccountCircleLine

} from "vue-remix-icons";
import SwitchLanguage from "./SwitchLanguage";


export default {
    name: "TopMenu",
    computed: {
        ...mapState({
            currentUser: state => state.auth.currentUser,
            profile: state => state.userProfile.data,
            isLoggedIn: state => state.auth.isLoggedIn
        }),
        ...mapGetters({
            currentUser: getterTypes.currentUser,
            isLoggedIn: getterTypes.isLoggedIn,
            isAnonymous: getterTypes.isAnonymous,
        }),

    },
    components: {
        RiAccountCircleLine,
        SwitchLanguage
    },
    methods: {
        onClick() {
            this.$store.dispatch(actionTypes.logout).then(() => {
                this.$router.push({path: '/home'})
            })
        },

    },
    watch: {},
    mounted() {


    }
}
</script>

<style lang="scss" scoped>
@import "resources/sass/app.scss";

.nav-item {
    margin: 5px 0;
}

.margin-left {
    margin-left: auto;
}

.prev-pic {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.icon-settings {
    color: rgba(0, 0, 0, .55);
    font-size: 1rem;
    vertical-align: middle;
}

.navbar-brand-link {
    text-decoration: none;
    margin: 5px 0;
}

.nav-link {
    color: rgba(0, 0, 0, .55);

}

a.router-link-exact-active, a.router-link-exact-active > ion-icon, li.router-link-active > a {
    color: #333030;
}

.navbar-brand {
    color: rgba(0, 0, 0, .55);
    font-size: x-large;
}

.dropdown-menu li:first-child a {
    display: flex;
}

.dropdown-menu-dark a {
    color: #e9ecef;
}

.menu-divider {
    margin: 0
}

.navbar-brand {

    color: $green;
}
</style>
