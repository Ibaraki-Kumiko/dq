<template>
    <div class="container">
        <div>
            <Breadcrumbs/>
        </div>
        <section class="dl-blurbs">
            <dl>
                <div v-for="module in firstList">
                    <router-link class="nav-link" :to="{name: 'module', params: {slug: module.slug}}" :class="{'disabled': module.status === 0}">
                        <dt>{{module.name}}</dt>
                        <dd>{{module.translation}}  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                            cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
                        </dd>
                    </router-link>

                </div>
            </dl>
            <dl>
                <div v-for="module in secondList">
                    <router-link class="nav-link" :to="{name: 'module', params: {slug: module.slug}}" :class="{'disabled': module.status === 0}">
                        <dt>{{module.name}}</dt>
                        <dd>{{module.translation}}  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                            cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
                        </dd>
                    </router-link>
                </div>
            </dl>
        </section>

    </div>
</template>

<script>
import Breadcrumbs from '../components/shared/Breadcrumbs';
export default {
    name: "Module2",

    data() {
        return {
            loading: false,
            description: '',
            modules: [],
            firstList: [],
            secondList: [],
        }
    },
    components: {
      Breadcrumbs
    },
    created() {
        this.loading = true;
        this.$store.commit('setLoading', true);
        axios
            .get(`/modules`)
            .then(response => {
                this.modules = response.data.data;
            })
            .then(() => {
                const middleIndex = Math.ceil(this.modules.length / 2);
                this.firstList = this.modules.slice(0, middleIndex);
                this.secondList = this.modules.slice(middleIndex);

        })
            .then(() => {
                this.$store.commit('setLoading', false);
                this.loading = false
            })
            .catch(error => {
                // Обработка ошибок
                if (error.response) {
                    // Сервер вернул статус, не являющийся 2xx
                    console.log('Ошибка:', error.response.status);
                    console.log('Данные ошибки:', error.response.data);
                } else if (error.request) {
                    // Запрос был сделан, но сервер не вернул ответ
                    console.log('Нет ответа от сервера:', error.request);
                } else {
                    // Что-то случилось при настройке запроса
                    console.log('Ошибка:', error.message);
                }
                console.log('Ошибка конфигурации:', error.config);
            });
    },

}
</script>

<style scoped lang="scss">
//- Google Fonts
$font-google-primary: 'https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap';
$font-google-secondary: 'https://fonts.googleapis.com/css2?family=Montserrat&display=swap';

//- @type List
$abril-fatface: 'Abril Fatface', cursive;
$montserrat: 'Montserrat', sans-serif;

//- Typography
$base-font-family: $montserrat;
$heading-font-family: $abril-fatface;

$font-size-small: 0.875em;

/*- Screen Sizes*/
$tablet-width: 768px;
$desktop-width: 1024px;

/* COLOR HEX */
$cadet: #4f6d7aff;
$maximum-blue: #5ea5b8ff;
$columbia-blue: #c0d6dfff;
$platinum: #eaeaeaff;
$cultured: #f3f3f3ff;
$nero: #444444;

/* COLOR Gradient */
$dl-gradient-right: linear-gradient(90deg, rgba(0, 0, 0, 0.04) 20%, rgba(255, 255, 255, 0) 0%);

$body-background-color: $platinum;
$body-text-color: $nero;

//- Global Functions
/*import fonts*/
@if variable-exists(font-google-primary) {
    @import url($font-google-primary);
}

@if variable-exists(font-google-secondary) {
    @import url($font-google-secondary);
}

//- Global Mixins

/*media queries*/
@mixin tablet {
    @media (min-width: #{$tablet-width}) and (max-width: #{$desktop-width - 1px}) {
        @content;
    }
}

@mixin desktop {
    @media (min-width: #{$desktop-width}) {
        @content;
    }
}

@mixin tablet-up {
    @media (min-width: #{$tablet-width}) {
        @content;
    }
}

html {
    box-sizing: border-box;
}

*, *:before, *:after {
    box-sizing: inherit;
}

body {
    background-color: $body-background-color;
/*    font-family: $base-font-family;*/
    font-size: $font-size-small;
    color: $body-text-color;
    line-height: 1.5;
}

.dl-blurbs {
    display: grid;
    @include tablet-up {
        grid-template-columns: repeat(2, 1fr);
        gap: 2vw;
    }
}

/* LIST */
dl {
    counter-reset: count;
    background: $dl-gradient-right;
    padding-left: 4vw; //default is smartphone
    padding-right: 4vw;
    margin: 0;
    @include tablet-up {
        padding-left: 2vw;
    }
    @include desktop {
        padding-top: 3vw;
        padding-bottom: 3vw;
    }

}

dl + dl {
    counter-reset: counter 4;
}

dt {
    counter-increment: count;
    color: #212529d9;
    /*font-family: $base-font-family;*/
 /*   font-size: 1vw;*/
    text-transform: uppercase;
}

dt::before {
    content: counter(count, decimal-leading-zero) ".";
    font-family: $heading-font-family;
    color: #dc3545;
    margin-left: -1vw;
    padding-right: 12px;
}

dd {
    margin-left: 5vw;
    margin-bottom: 2vh;
}

.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
