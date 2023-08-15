<template>
    <div class="auth-page">
        <div class="container page">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-xs-12">
                    <h1 class="text-xs-center">Sign in</h1>
                    <p class="text-xs-center">
                        Нет аккаунта?
                        <router-link :to="{name: 'register'}">
                            Создать новый аккаунт
                        </router-link>
                    </p>

                    <ValidationErrors   v-if="validationErrors" :validation-errors="validationErrors"></ValidationErrors>
                    <div  v-if="hasErrorFor('email')">
                        Эти учетные данные не соответствуют нашим записям
                    </div>
                    <form @submit.prevent='onSubmit'>

                        <fieldset class="form-group mt-3">
                            <input
                                class="form-control form-control-lg"
                                type="text"
                                placeholder="Email"
                                v-model="email"
                                @blur="$v.email.$touch()"
                                :class="[{'is-invalid': hasErrorFor('email') || ($v.email.$dirty && (!$v.email.required) || !$v.email.email)}]"
                            />
                            <div class="invalid-feedback" v-if="$v.email.$dirty && !$v.email.required">Поле обязательно для заполнения</div>
                            <div class="invalid-feedback" v-if="$v.email.$dirty && !$v.email.email">Введите валидный email</div>
                        </fieldset>
                        <fieldset class="form-group mt-3">
                            <input
                                class="form-control form-control-lg"
                                type="password"
                                placeholder="Password"
                                v-model="password"
                                @blur="$v.password.$touch()"
                                :class="[{'is-invalid': hasErrorFor('password') || ($v.password.$dirty && (!$v.password.required || !$v.password.minLength))}]"
                            />
                            <div class="invalid-feedback" v-if="$v.password.$dirty && !$v.password.required">Поле обязательно для заполнения</div>
                            <div class="invalid-feedback" v-if="$v.password.$dirty && !$v.password.minLength">Минимальная длина пароля {{this.$v.password.$params.minLength.min}} символов</div>
                        </fieldset>
                        <div class="mb-2">
                            <router-link to="/forgot">Forgot Password?</router-link>
                        </div>
                        <button class="btn btn-lg btn-outline-primary pull-xs-right mt-3" :disabled="isSubmitting || $v.$invalid">
                            Sign in
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>


<script>

import {actionTypes} from "../store/modules/auth";
import {mapState} from "vuex"
import ValidationErrors from "../shared/components/ValidationErrors";
import validationErrors from "../shared/mixin/validationErrors";
import { required, minLength, email, sameAs, requiredIf, url } from 'vuelidate/lib/validators'

export default {
    name: "LoginPage",
    mixins: validationErrors,
    components: {
        ValidationErrors
    },

    data() {
        return {
            email: '',
            password: '',
        }
    },
    computed: {
        ...mapState({
            isSubmitting: state => state.auth.isSubmitting,
            validationErrors: state => state.auth.validationErrors
        })
    },
    validations: {

        email: {
            required,
            email,
        },
        password: {
            required,
            minLength: minLength(8),
        },
    },

    methods: {
        onSubmit() {
            this.$store.dispatch(actionTypes.login, {email: this.email, password: this.password})
                .then((res) => {
                    res.is_admin ?   this.$router.push({path: '/admin'}) : this.$router.push({path: '/'})

                })
        },
        hasErrorFor(field){
            if(this.$store.state.auth.validationErrors && this.$store.state.auth.validationErrors.hasOwnProperty(field)) {
                console.log(this.$store.state.auth.validationErrors)
                return true
            }
            else {
                return null
            }
        }
    }
}
</script>

<style scoped>

</style>
