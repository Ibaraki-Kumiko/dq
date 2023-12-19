<template>
    <form class="form-signin" @submit.prevent="OnSubmit">
        <div v-if="cls" :class="`alert alert-${cls}`" role="alert">
            {{ message }}
        </div>

        <h1 class="h3 mb-3 font-weight-normal">Please set your email</h1>

        <input v-model="email" type="email" class="form-control mb-3" placeholder="Email" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" >Submit</button>
    </form>
</template>

<script>

import axios from 'axios';


export default {
    name: "Forgot",
    data() {
        return {
            email: '',
            cls: '',
            message: ''
        }
    },
    methods: {
        async OnSubmit() {
            try {
                await axios.post('/forgot', {
                    email: this.email
                });
                this.cls = 'success';
                this.message = 'Email was sent! Please check your email!';

            } catch (e) {
                this.cls = 'danger';
                this.message = 'Email does not exist!';
            }
        }
    }
}
</script>

<style scoped>

</style>
