<template>
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item">
                <router-link class="nav-link px-2 text-muted" :to="{name: 'home'}" exact active-class="active">
                    <p>{{ $t("Footer.home") }}</p>
                </router-link></li>
            <li class="nav-item">
                <router-link class="nav-link px-2 text-muted" :to="{name: 'about'}" exact active-class="active">
                    {{ $t("Footer.about") }}</router-link></li>
            <li class="nav-item">
                <router-link class="nav-link px-2 text-muted" :to="{name: 'contacts'}" exact active-class="active">
                    {{ $t("Footer.contacts") }}
            </router-link></li>

        </ul>
        <p class="text-center text-muted">© 2023 Deutsche Quelle</p>
    </footer>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style scoped>

</style>
