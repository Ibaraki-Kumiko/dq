import VueRouter from "vue-router";

import HomePage from "../views/HomePage";
import RegisterPage from "../views/RegisterPage";
import LoginPage from "../views/LoginPage";
import NotFound from "../views/NotFoundPage";
import ContactPage from "../views/ContactPage";

import UnitPage from "../views/UnitPage";
import AlgoliaSearch from "../views/SearchForm";
import termPage from "../views/TermPage";
import UploadTerms from "../views/admin/UploadTerms";
import Exercise from "../views/Exercise";

import Modules from "../views/ModulesPage";
import UnitsPage from "../views/UnitsPage";
import ExercisesPage from "../views/ExercisesPage";
import TheoryPage from "../views/TheoryPage";
import AboutUsPage from "../views/AboutUsPage";
import AllExercisesPage from "../views/AllExercisesPage";
import ResetPage from "../views/ResetPage";
import ForgotPage from "../views/ForgotPage";




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
        path: '/reset/:token',
        name: 'reset',
        component: ResetPage
    },

    {
        path: '/forgot',
        name: 'forgot',
        component: ForgotPage
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
        path: '/modules',
        name: 'modules',
        component: Modules,
        meta: { label: 'Грамматика' }
    },

    {
        path: '/modules/:slug',
        name: 'module',
        component: UnitsPage
    },
    {
        path: '/modules/:slug/:unit_slug',
        name: 'unit',
        component: UnitPage
    },
    {
        path: '/dictionary',
        name: 'dictionary',
        component: AlgoliaSearch
    },
    {
        path: '/dictionary/:slug',
        name: 'term',
        component: termPage
    },

    {
        path: '/upload',
        name: 'upload',
        component: UploadTerms
    },

    {
        path: '/modules/:id/:unit_id/exercises/',
        name: 'exercises',
        component: ExercisesPage
    },

    {
        path: '/modules/:module_slug/:unit_slug/exercises/:exercise_id',
        name: 'common',
        component: Exercise
    },

    {
        path: '/exercises',
        name: 'allExercises',
        component: AllExercisesPage
    },

    {
        path: '/about',
        name: 'about',
        component: AboutUsPage
    },

    {
        path: "/:notFound",
        name: 'not-found',
        component: NotFound,
    },


]



const router = new VueRouter({
    routes,
    mode: 'history'
});




export default router;
