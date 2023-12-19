<template>
    <form class="form-signin" @submit.prevent="onSubmit">
        <h1 class="h3 mb-3 fw-normal">Please reset your password</h1>

        <div class="form-floating">
            <input v-model="password" type="password" class="form-control" placeholder="Password">
            <label>Password</label>
        </div>

        <div class="form-floating">
            <input v-model="password_confirm" type="password" class="form-control" placeholder="Password Confirm">
            <label>Password Confirm</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
    </form>
</template>

<script>
import axios from "axios";

export default {
    name: "ResetPage",
    data() {
        return {
            password: '',
            password_confirm: ''

        }
    },
    methods: {
        async onSubmit() {
            await axios.post('reset', {
                password: this.password,
                token: this.$route.params.token
            });
            await this.$router.push({path: '/login'})

        }
    }
}
</script>

<style scoped>

</style>
