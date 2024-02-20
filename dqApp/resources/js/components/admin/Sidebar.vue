<template>
    <div>
        <div class="dashboard-container">
            <RiDashboard3Line class="dashboard-icon"></RiDashboard3Line>
            <h5 class="dashboard-text" @click="changeComponent('DashboardContent')">Dashboard</h5>
        </div>


        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Users
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"> <button @click="changeComponent('Permissions')" >Permissions</button></div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                       Statistic
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"></div>
                </div>
            </div>
<!--            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" @click="changeComponent('Modules')" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Modules
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"></div>
                </div>
            </div>-->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Modules
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"> <button @click="changeComponent('Modules')" >Modules</button></div>
                </div>
            </div>
        </div>
<!--        <button @click="changeComponent('DashboardContent')" >Dashboard</button>
        <button @click="changeComponent('Permissions')" >Permissions</button>
        <button @click="changeComponent('other')" >Other</button>-->

    </div>
</template>

<script>
import { RiDashboard3Line} from "vue-remix-icons";


export default {
    name: "Sidebar",
    components: {
        RiDashboard3Line
    },


    methods: {
        changeComponent(type) {
            console.log("this type", type)
            this.$emit('changeComponent', type);
        }
    }
}
</script>

<style scoped>
.dashboard-container {
    display: flex; /* Размещаем элементы внутри контейнера в строку */
    align-items: center; /* Выравниваем элементы по центру по вертикали */
    padding: 8px 0;
    min-height: 39px;
}
.dashboard-icon {
    height : 28px;
    margin-right: 8px;
    margin-bottom: 8px;
}
.dashboard-text {
    padding: 8px 0;
}
</style>
