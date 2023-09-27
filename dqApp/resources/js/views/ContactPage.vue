<template>
    <div class="container">
        <!-- <ValidationErrors   v-if="validationErrors" :validation-errors="validationErrors"></ValidationErrors>&ndash;&gt;-->
        <!--<div  v-if="hasErrorFor('email')">
            Эти учетные данные не соответствуют нашим записям
        </div>-->
        <Message severity="error" v-if="errorMessage" :closable="false">{{ errorMessage }}</Message>
        <form @submit.prevent="onSubmit" class="contact100-form validate-form">
            <span class="contact100-form-title">
            Contact Us
            </span>
            <div class="wrap-input100 rs1-wrap-input100">

                <span class="label-input100">Ваше имя</span>

                <input
                    class="input100"
                    type="text"
                    name="name"

                    v-model="name"
                    @blur="$v.name.$touch()">
                <!--:class="[{'is-invalid': hasErrorFor('name') || ($v.name.$dirty && (!$v.name.required))}]"-->
                <!--  :placeholder="$v.name.$dirty && !$v.name.required ? '' : 'Введите Ваше имя'"-->


                <span class="focus-input100"></span>
                <div class="invalid">{{ $v.name.$error ? 'Поле обязательно для заполнения' : '' }}</div>
            </div>
            <div class="wrap-input100 rs1-wrap-input100 validate-input">
                <span class="label-input100">Email</span>
                <input
                    class="input100"
                    type="text"
                    name="email"

                    v-model="email"
                    @blur="$v.email.$touch()">
                <!-- :class="[{'is-invalid': hasErrorFor('email') || ($v.email.$dirty && (!$v.email.required) || !$v.email.email)}]"-->
                <!--  :placeholder="($v.email.$dirty && (!$v.email.required) || !$v.email.email) ? '' : 'Введите e-mail'"-->
                <span class="focus-input100"></span>
                <div class="invalid">{{
                        $v.email.$dirty && !$v.email.required ? 'Поле обязательно для заполнения' : $v.email.$dirty && !$v.email.email ? 'Введите валидный email' : ''
                    }}
                </div>
                <!--                <div class="invalid" v-if="$v.email.$dirty && !$v.email.email">Введите валидный email</div>-->
            </div>
            <div class="wrap-input100 validate-input rs1-wrap-textarea100">
                <span class="label-input100">Сообщение</span>
                <textarea
                    class="input100"
                    name="message"
                    @blur="$v.message.$touch()"
                    v-model="message">
                   <!--  :placeholder="$v.message.$dirty && !$v.message.required ? '' : 'Введите Ваше сообщение...'"-->
                    <!-- :class="[{'is-invalid': hasErrorFor('message') || ($v.message.$dirty && !$v.message.required)}]"-->


                </textarea>

                <span class="focus-input100"></span>
                <!--    <div class="invalid" v-if="$v.message.$dirty && !$v.message.required">Поле обязательно для заполнения</div>-->
                <div class="invalid">{{ $v.message.$error ? 'Поле обязательно для заполнения' : '' }}</div>
            </div>

            <div class="container-contact100-form-btn">
                <button class="button" :disabled="isSubmitting || $v.$invalid">
                <span>Submit
                </span>
                </button>
            </div>
        </form>
    </div>

</template>

<script>
import {actionTypes} from "../store/modules/contacts";
import {mapState} from "vuex"
// import ValidationErrors from "../shared/components/ValidationErrors";

import {required, email} from 'vuelidate/lib/validators'
/*import validationErrors from "../shared/mixin/validationErrors";*/
import Toast from 'primevue/toast';
import Message from 'primevue/message';

export default {
    name: "ContactPage",
    // mixins: validationErrors,
    components: {
        // ValidationErrors
        Toast,
        Message
    },
    data() {
        return {
            email: '',
            name: '',
            message: '',
            errorMessage: null
        }
    },
    computed: {
        ...mapState({
            isSubmitting: state => state.contacts.isSubmitting,
            validationErrors: state => state.contacts.validationErrors
        })
    },
    validations: {

        email: {
            required,
            email,
        },
        name: {
            required,
        },
        message: {
            required,
        },
    },
    methods: {
        removeMessages() {
            console.log("Ädsd")
            //this.messages = null;
        },
        onSubmit() {
            this.$store.dispatch(actionTypes.feedback, {email: this.email, name: this.name, message: this.message})
                .then(() => {
                    this.$store.commit('updateToastMessage', "Ваше сообщение успешно отправлено");
                    this.$router.push({path: '/'})
                }).catch(error =>
                this.errorMessage = "Что-то пошло не так. Ваше сообщение не было отправлено. Попробуйте позже еще раз",
            )


        },
        hasErrorFor(field) {
            if (this.$store.state.contacts.validationErrors && this.$store.state.contacts.validationErrors.hasOwnProperty(field)) {
                console.log(this.$store.state.contacts.validationErrors)
                return true
            } else {
                return null
            }
        }
    }
}
</script>

<style scoped lang="scss">
@import "resources/sass/app.scss";


.input100t:focus {
    border-color: blue;
    outline: none;
}

.invalid {
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    min-height: 20px;
    color: var(--bs-form-invalid-color);
}

.container {
    width: 100%;
    min-height: 75vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background: 0 0;
    position: relative;
    z-index: 1
}


input {
    outline: none;
    border: none
}

textarea {
    outline: none;
    border: none
}

textarea:focus, input:focus {
    border-color: transparent !important
}

input:focus::-webkit-input-placeholder {
    color: transparent
}

textarea:focus::-webkit-input-placeholder {
    color: transparent
}

input::-webkit-input-placeholder {
    color: #555
}

textarea::-webkit-input-placeholder {

    color: #555
}

.contact100-form {
    width: 100%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding-bottom: 68px;
}

.contact100-form-title {
    display: block;
    width: 100%;

    font-size: 39px;
    color: #333;
    line-height: 1.2;
    text-align: left;
    padding-bottom: 44px;
}


.validate-input {
    position: relative;
}


.wrap-input100 {
    position: relative;
    //border-bottom: 2px solid #d9d9d9;
    padding-bottom: 13px;
    //  margin-bottom: 65px;
}

.rs1-wrap-input100 {
    width: calc((100% - 30px) / 2);

}

.rs1-wrap-textarea100 {
    width: 100%
}

/*
.focus-input100::before {
    content: "";
    display: block;
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    -webkit-transition: all .4s;
    -o-transition: all .4s;
    -moz-transition: all .4s;
    transition: all .4s;
    background: #ff4b5a;
}
*/

.label-input100 {
    /*   font-family: Poppins-Regular,sans-serif;*/
    font-size: 15px;
    color: #999;
    line-height: 1.5;
    //  padding-left: 5px;
}

input.input100 {
    height: 40px;
}

.input100 {
    display: block;
    width: 100%;
    //background: 0 0;
    font-size: 18px;
    color: #555;
    line-height: 1.2;
    padding: 0 5px;
    border-radius: 5px;
}

input {
    outline: none;
    border: none;
}

/*
.focus-input100 {
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}
*/

/*.focus-input100::before {
    content: "";
    display: block;
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    -webkit-transition: all .4s;
    -o-transition: all .4s;
    -moz-transition: all .4s;
    transition: all .4s;
    background: #04cba0
}*/
.container-contact100-form-btn {
    width: 100%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    margin-top: -25px;
}

input.input100 {
    height: 40px
}

textarea.input100 {
    min-height: 110px;
    padding-top: 9px;
    padding-bottom: 13px
}

.input100:focus + .focus-input100::before {
    width: 100%
}

.has-val.input100 + .focus-input100::before {
    width: 100%
}

.contact100-form-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    min-width: 160px;
    height: 50px;
    /* background-color: #ff4b5a;*/
    background-color: $green;
    border-radius: 25px;
    /*  font-family: Poppins-Medium,sans-serif;*/
    font-size: 16px;
    color: #fff;
    line-height: 1.2;
    -webkit-transition: all .4s;
    -o-transition: all .4s;
    -moz-transition: all .4s;
    transition: all .4s;
    box-shadow: 0 10px 30px 0 rgb(4, 203, 160);
    -moz-box-shadow: 0 10px 30px 0 rgb(4, 203, 160);
    -webkit-box-shadow: 0 10px 30px 0 rgb(0, 0, 0);
    -o-box-shadow: 0 10px 30px 0 rgb(4, 203, 160);
    -ms-box-shadow: 0 10px 30px 0 rgb(4, 203, 160);
}

@media(max-width: 992px) {
    .wrap-contact100 {
        padding: 82px 80px 33px
    }
}

@media(max-width: 768px) {
    .rs1-wrap-input100 {
        width: 100%
    }
}

@media(max-width: 576px) {
    .wrap-contact100 {
        padding: 82px 15px 33px
    }
}

.alert-validate::before {
    content: attr(data-validate);
    position: absolute;
    max-width: 70%;
    background-color: #fff;
    border: 1px solid #c80000;
    border-radius: 2px;
    padding: 4px 25px 4px 10px;
    top: 58%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 2px;
    pointer-events: none;
    font-family: Poppins-Medium;
    color: #c80000;
    font-size: 13px;
    line-height: 1.4;
    text-align: left;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: opacity .4s;
    -o-transition: opacity .4s;
    -moz-transition: opacity .4s;
    transition: opacity .4s
}

.alert-validate::after {
    content: "\f06a";
    font-family: FontAwesome;
    display: block;
    position: absolute;
    color: #c80000;
    font-size: 16px;
    top: 58%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 8px
}

.alert-validate:hover:before {
    visibility: visible;
    opacity: 1
}

@media(max-width: 992px) {
    .alert-validate::before {
        visibility: visible;
        opacity: 1
    }
}


</style>
