<template>
    <div class="container">
        <form class="contact100-form validate-form">
            <span class="contact100-form-title">
            Contact Us
            </span>
            <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
                <span class="label-input100">Ваше имя</span>
                <input class="input100" type="text" name="name" placeholder="Введите Ваше">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                <span class="label-input100">Email</span>
                <input class="input100" type="text" name="email" placeholder="Введите email">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input rs1-wrap-textarea100" data-validate="Message is required">
                <span class="label-input100">Сообщение</span>
                <textarea class="input100" name="message" placeholder="Введите Ваше сообщение..."></textarea>
                <span class="focus-input100"></span>
            </div>
            <div class="container-contact100-form-btn">
                <button class="button">
                <span>Submit
                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
                </button>
            </div>
        </form>
    </div>

</template>

<script>
import {actionTypes} from "../store/modules/auth";
import {mapState} from "vuex"
import ValidationErrors from "../shared/components/ValidationErrors";

import { required, minLength, email, sameAs, requiredIf, url } from 'vuelidate/lib/validators'
import validationErrors from "../shared/mixin/validationErrors";


export default {
    name: "ContactPage",
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

<style scoped lang="scss">
@import "resources/sass/app.scss";

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

textarea:focus,input:focus {
    border-color: transparent!important
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
    border-bottom: 2px solid #d9d9d9;
    padding-bottom: 13px;
    margin-bottom: 65px;
}
.rs1-wrap-input100 {
     width: calc((100% - 30px) / 2);

}
.rs1-wrap-textarea100 {
    width: 100%
}

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

.label-input100 {
 /*   font-family: Poppins-Regular,sans-serif;*/
    font-size: 15px;
    color: #999;
    line-height: 1.5;
    padding-left: 5px;
}

input.input100 {
    height: 40px;
}

.input100 {
    display: block;
    width: 100%;
    background: 0 0;
    font-size: 18px;
    color: #555;
    line-height: 1.2;
    padding: 0 5px;
}

input {
    outline: none;
    border: none;
}

.focus-input100 {
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}

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
    background: #04cba0
}
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

.input100:focus+.focus-input100::before {
    width: 100%
}

.has-val.input100+.focus-input100::before {
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
        padding:82px 80px 33px
    }
}

@media(max-width: 768px) {
    .rs1-wrap-input100 {
        width:100%
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
        visibility:visible;
        opacity: 1
    }
}


</style>
