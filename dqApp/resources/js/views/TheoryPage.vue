<template>
    <div class="container">
        <section>
            <div>
                <h1>Lorem ipsum dolor</h1>
                <div class="divider"></div>
                <div class="content">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                    labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                    labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br>
                </div>

                <div class="vertical-line">
                    <div class="rule">
                        <h3 class="">Learn to enjoy every minute of your life.</h3>
                        <p class="">Quick can manor smart money hopes worth too. Comfort produce husband boy her had
                            hearing. Law others
                            theirs passed but wishes. You day real less till dear read
                        </p>
                    </div>

                </div>

                <div class="wrap-table">
                    <table class="table-standart">
                        <thead>
                        <tr class="row100">
                            <th></th>
                            <th>Column</th>
                            <th>Column</th>
                            <th>Column</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="row100">
                            <td>Lorem</td>
                            <td>ipsum</td>
                            <td>dolor</td>
                            <td>sit</td>
                        </tr>
                        <tr class="row100">
                            <td>Lorem</td>
                            <td>ipsum</td>
                            <td>dolor</td>
                            <td>sit</td>
                        </tr>
                        <tr class="row100">
                            <td>Lorem</td>
                            <td>ipsum</td>
                            <td>dolor</td>
                            <td>sit</td>
                        </tr>
                        <tr class="row100">
                            <td>Lorem</td>
                            <td>ipsum</td>
                            <td>dolor</td>
                            <td>sit</td>
                        </tr>
                        <tr class="row100">
                            <td>Lorem</td>
                            <td>ipsum</td>
                            <td>dolor</td>
                            <td>sit</td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </section>
        <div class="divider"></div>
        <section>
            <exercises-page></exercises-page>
        </section>
    </div>
</template>

<script>
import ExercisesPage from "./ExercisesPage";
export default {
    name: "TheoryPage",
    components:{
        ExercisesPage
    }

}
</script>

<style scoped>
.divider {
    margin-top: 20px;
    margin-bottom: 20px;
    height: 3px;
    transform-origin: left center;
    border-color: #de425b;
    border-width: 3px;
    border-style: solid;
}

.content {

}

.vertical-line {
    position: relative;
    padding-left: 20px;
    margin: 50px;
}

.vertical-line::before {
    content: "";
    position: absolute;

    top: 0;
    left: 0;
    height: 100%;
    border-left: 4px solid #de425b;
}

.rule {
    padding: 0;
    margin: 0;

}

.wrap-table {
    margin: 100px  0;
}

.table-standart {
    width: 100%;
    background-color: #fff;
}

.table-standart th {
    font-size: 12px;
    color: #fff;
    line-height: 1.4;
    text-transform: uppercase;
    background-color: #212529d9;
    padding-top: 24px;
    padding-bottom: 20px;
    padding-left: 10px;
}

.table-standart td {
    padding: 10px;

}

.table-standart td:hover {

    background-color: #212529d9;
    color: #fff;
}

.table-standart .row100:hover {
    background-color: #f2f2f2
}

.table-standart .hov-column-ver1 {
    background-color: #f2f2f2
}

.table-standart .hov-column-head-ver1 {
    background-color: #484848 !important
}

</style>
