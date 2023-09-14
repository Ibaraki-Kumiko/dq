import VueRouter from "vue-router";

import HomePage from "../components/HomePage";
import RegisterPage from "../views/RegisterPage";
import LoginPage from "../views/LoginPage";
import NotFound from "../components/NotFound";
import ContactPage from "../components/ContactPage";
import AlgoliaSearch from "../views/SearchForm";

import Modules from "../views/Modules";
import ModulePage from "../views/ModulePage";
import UnitPage from "../views/UnitPage";

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },

    {
        path: '/register',
        name: 'register',
        component: RegisterPage
    },
    {
        path: '/login',
        name: 'login',
        component: LoginPage
    },

    {
        path: '/logout',
        name: 'logout',
    },
    {
        path: "/contacts",
        name: 'contacts',
        component: ContactPage,
    },
    {
        path: '/dictionary',
        name: 'dictionary',
        component: AlgoliaSearch
    },

    {
        path: '/modules',
        name: 'modules',
        component: Modules
    },
    {
        path: '/modules/:id',
        name: 'module',
        component: ModulePage
    },
    {
        path: '/modules/:id/:unit_id',
        name: 'unit',
        component: UnitPage
    },
    {
        path: "/:notFound",
        component: NotFound,
    },


]

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
