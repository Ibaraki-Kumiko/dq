<template>
    <section class="page-wrapper">
        <div class="content-wrapper">
        <div class="centered-text">
            <h1 class="title"><b>Coming Soon</b></h1>
<!--            <p class="desc">Our website is currently undergoing scheduled maintenance.
                We Should be back shortly. Thank you for your patience.</p>-->
            <p class="desc">Сайт в разработке. В скором времени мы вернемся! </p>
            <p class="desc">Diese Website befindet sich gerade im Aufbau. Wir sind bald zurück! </p>
        </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "HomePage"
}
</script>

<style scoped>
.centered-text {
    display: flex;
    align-items: center; /* центрируем элементы по вертикали */
    justify-content: center; /* центрируем элементы по горизонтали */
    flex-direction: column;
    height: 60vh;
   /* text-align: center;*/
}

.title {
    font-size: 3.25rem;
}

.desc {
    font-size: 2rem;
}
</style>
