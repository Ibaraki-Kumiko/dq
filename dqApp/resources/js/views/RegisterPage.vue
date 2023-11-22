<template>
    <div class="auth-page">
        <div class="container page">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-xs-12">
                    <h1 class="text-xs-center">{{ $t("RegisterPage.signUp") }}</h1>
                    <p class="text-xs-center">
                        {{ $t("RegisterPage.doYouHaveAnAccount") }}
                        <router-link :to="{name: 'login'}">
                            {{ $t("RegisterPage.signIn") }}
                        </router-link>
                    </p>


                    <form @submit.prevent='onSubmit'>
                        <fieldset class="form-group mt-3">
                            <input
                                class="form-control form-control-lg"
                                type="text"
                                placeholder="Username"
                                v-model="username"
                                @blur="$v.username.$touch()"

                                :class="[{'is-invalid': hasErrorFor('username')  || ($v.username.$dirty && (!$v.username.minLength || !$v.username.required) )}]"
                            />
                            <div class="invalid-feedback" v-if="hasErrorFor('username')">


                            </div>
                            <div class="invalid-feedback" v-if="$v.username.$dirty && !$v.username.required">
                                {{ $t("errorsMessages.fieldIsRequired") }}
                            </div>
                            <div class="invalid-feedback" v-if="$v.username.$dirty &&  !$v.username.minLength">
                                {{ $t("errorsMessages.minimalLength") }}
                            </div>
                        </fieldset>
                        <fieldset class="form-group mt-3">
                            <input
                                class="form-control form-control-lg"
                                type="text"
                                placeholder="Email"
                                v-model="email"
                                @blur="$v.email.$touch()"

                                :class="[{'is-invalid': hasErrorFor('email') || ($v.email.$dirty && (!$v.email.required) || !$v.email.email)}]"
                            />
                            <div class="invalid-feedback" v-if="hasErrorFor('email')">
                                {{ $t("errorsMessages.EnterAValidEmail") }}
                            </div>
                            <div class="invalid-feedback" v-if="$v.email.$dirty && !$v.email.required">
                                {{ $t("errorsMessages.fieldIsRequired") }}
                            </div>
                            <div class="invalid-feedback" v-if="$v.email.$dirty && !$v.email.email">
                                {{ $t("errorsMessages.EnterAValidEmail") }}
                            </div>
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
                            <div class="invalid-feedback" v-if="hasErrorFor('password')">
                                {{ $t("errorsMessages.PasswordMinLength") }}
                            </div>
                            <div class="invalid-feedback" v-if="$v.password.$dirty && !$v.password.required">
                                {{ $t("errorsMessages.fieldIsRequired") }}
                            </div>
                            <div class="invalid-feedback" v-if="$v.password.$dirty && !$v.password.minLength">
                                {{ $t('errorsMessages.MinLength', { msg: this.$v.password.$params.minLength.min  }) }}

                            </div>

                        </fieldset>
                        <button class="btn btn-lg btn-outline-primary pull-xs-right mt-3"
                                :disabled="isSubmitting || $v.$invalid">
                            {{ $t("RegisterPage.signUp") }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
import ValidationErrors from "../shared/components/ValidationErrors";
import {actionTypes} from "../store/modules/auth";
import {mapState} from "vuex"
import validationErrors from "../shared/mixin/validationErrors";
import {validationMixin} from 'vuelidate';
import {required, minLength, email, sameAs, requiredIf, url} from 'vuelidate/lib/validators'

export default {
    name: "RegisterPage",
    mixins: [validationMixin, validationErrors],
    components: {
        ValidationErrors
    },
    data() {
        return {
            email: '',
            password: '',
            username: ''
        }
    },
    validations: {
        username: {
            required,
            minLength: minLength(2),
        },
        email: {
            required,
            email,
        },
        password: {
            required,
            minLength: minLength(8),
        },

    },
    computed: {
        ...mapState({
            isSubmitting: state => state.auth.isSubmitting,
            validationErrors: state => state.auth.validationErrors
        }),

    },
    methods: {
        onSubmit() {
            this.$v.$touch();
            this.$store.dispatch(actionTypes.register, {
                email: this.email,
                name: this.username,
                password: this.password
            }).then(user => {
                this.$router.push({name: 'home'})

            })
        },
        hasErrorFor(field) {
            if (this.$store.state.auth.validationErrors && this.$store.state.auth.validationErrors.hasOwnProperty(field)) {
                return true
            } else {
                return null
            }

        }
    }
}
</script>

<style scoped>

</style>
