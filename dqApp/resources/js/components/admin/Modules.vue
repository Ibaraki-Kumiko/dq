<template>
<!--    <div class="container">
        <div class="row">
            <h2>Модули</h2>
            <template v-for="(module, index) in modules">
                <div :key="module.id">
                    <h5>{{module.translation }}</h5>
                    <SpeedDial :model="items" :key="index"/>
                    <router-link class="nav-link" :to="{name: 'module', params: {id: module.id}}">{{module.translation }}
                    </router-link>
                </div>

            </template>

        </div>
    </div>-->
    <div>
        <Toast />
        <h1>Modules</h1>
        <div class="card">
            <Toolbar class="mb-4">
                <template #start>
                    <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
                    <Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedProducts || !selectedProducts.length" />
                </template>

                <template #end>
                    <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import" chooseLabel="Import" class="mr-2 inline-block" />
                    <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)"  />
                </template>
            </Toolbar>

           <DataTable ref="dt" :value="products" :selection.sync="selectedProducts" dataKey="id" :key="componentKey"
                      :paginator="true" :rows="10" :filters="filters"
                       paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
                       currentPageReportTemplate="Showing {first} to {last} of {totalRecords} modules" responsiveLayout="scroll">
                <template #header>
                    <div class="table-header flex flex-column md:flex-row md:justify-content-between">
                        <h5 class="mb-2 md:m-0 md:align-self-center">Manage Modules</h5>
                        <span class="p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText v-model="filters['global'].value" placeholder="Search..." />
                </span>
                    </div>
                </template>

                <Column selectionMode="multiple" :styless="{width: '3rem'}" :exportable="false"></Column>
                <Column field="id" header="Code" :sortable="true" :styles="{'min-width':'10rem'}"></Column>
                <Column field="name" header="Name" :sortable="true" :styles="{'min-width':'16rem'}" #body="slotProps">   <router-link class="nav-link" :to="{name: 'admin.units', params: {id: slotProps.data.id }}">{{slotProps.data.name}}  </router-link></Column>
                <Column field="translation" header="Translation" :sortable="true" :styles="{'min-width':'16rem'}"></Column>
<!--                <Column header="Image">
                    <template #body="slotProps">
                        <img :src="'demo/images/product/' + slotProps.data.image" :alt="slotProps.data.image" class="product-image" />
                    </template>
                </Column>-->
<!--                <Column field="price" header="Price" :sortable="true" :styles="{'min-width':'8rem'}">
                    <template #body="slotProps">
                        {{formatCurrency(slotProps.data.price)}}
                    </template>
                </Column>-->
                <Column field="category" header="Category" :sortable="true" :styles="{'min-width':'10rem'}"></Column>
<!--                <Column field="rating" header="Reviews" :sortable="true" :styles="{'min-width':'12rem'}">
                    <template #body="slotProps">
                        <Rating :value="slotProps.data.rating" :readonly="true" :cancel="false" />
                    </template>
                </Column>-->
                <Column field="inventoryStatus" header="Status" :sortable="true" :styles="{'min-width':'12rem'}">
                    <template #body="slotProps">
                        <span :class="'product-badge status-' + (slotProps.data.inventoryStatus ? slotProps.data.inventoryStatus.toLowerCase() : '')">{{slotProps.data.inventoryStatus}}</span>
                    </template>
                </Column>
                <Column :exportable="false" :styles="{'min-width':'8rem'}">
                    <template #body="slotProps">
                        <Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editProduct(slotProps.data)" />
                        <Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="confirmDeleteProduct(slotProps.data)" />
                    </template>
                </Column>
            </DataTable>
        </div>

       <Dialog :visible.sync="productDialog" :style="{width: '450px'}" header="Module Details" :modal="true" class="p-fluid">
<!--            <img :src="'demo/images/product/' + product.image" :alt="product.image" class="product-image" v-if="product.image" />-->
            <div class="field">
                <label for="name">Name</label>
                <InputText id="name" v-model.trim="product.name" required="true" autofocus :class="{'p-invalid': submitted && !product.name}" />
                <small class="p-invalid" v-if="submitted && !product.name">Name is required.</small>
            </div>
            <div class="field">
                <label for="translation">Translation</label>
                <Textarea id="translation" v-model="product.translation" required="true" rows="3" cols="20" />
            </div>

<!--            <div class="field">
                <label class="mb-3">Category</label>
                <div class="formgrid grid">
                    <div class="field-radiobutton col-6">
                        <RadioButton id="category1" name="category" value="Accessories" v-model="product.category" />
                        <label for="category1">Accessories</label>
                    </div>
                    <div class="field-radiobutton col-6">
                        <RadioButton id="category2" name="category" value="Clothing" v-model="product.category" />
                        <label for="category2">Clothing</label>
                    </div>
                    <div class="field-radiobutton col-6">
                        <RadioButton id="category3" name="category" value="Electronics" v-model="product.category" />
                        <label for="category3">Electronics</label>
                    </div>
                    <div class="field-radiobutton col-6">
                        <RadioButton id="category4" name="category" value="Fitness" v-model="product.category" />
                        <label for="category4">Fitness</label>
                    </div>
                </div>
            </div>-->

<!--            <div class="formgrid grid">
                <div class="field col">
                    <label for="price">Price</label>
                    <InputNumber id="price" v-model="product.price" mode="currency" currency="USD" locale="en-US" />
                </div>
                <div class="field col">
                    <label for="quantity">Quantity</label>
                    <InputNumber id="quantity" v-model="product.quantity" integeronly />
                </div>
            </div>-->
            <template #footer>
                <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialog"/>
                <Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveProduct" />
            </template>
        </Dialog>

       <Dialog :visible.sync="deleteProductDialog" :styles="{width: '450px'}" header="Confirm" :modal="true">
            <div class="confirmation-content">
                <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                <span v-if="product">Are you sure you want to delete <b>{{product.name}}</b> module?</span>
            </div>
            <template #footer>
                <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductDialog = false"/>
                <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteProduct" />
            </template>
        </Dialog>

        <Dialog :visible.sync="deleteProductsDialog" :styles="{width: '450px'}" header="Confirm" :modal="true">
            <div class="confirmation-content">
                <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                <span v-if="product">Are you sure you want to delete the selected modules?</span>
            </div>
            <template #footer>
                <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductsDialog = false"/>
                <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSelectedProducts" />
            </template>
        </Dialog>
    </div>

</template>

<script>

import Toolbar from 'primevue/toolbar';
import Button from 'primevue/button';
import FileUpload from 'primevue/fileupload';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import InputText from 'primevue/inputtext';
import Dialog from 'primevue/dialog';
import RadioButton from 'primevue/radiobutton';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';

import {FilterMatchMode} from 'primevue/api';

import {PrimeIcons} from 'primevue/api';
import Toast from 'primevue/toast';

/*import{actionTypes as actionTypes2 }from "../../../store/modules/module/removeModule";
import{actionTypes as actionTypes3 }from "../../../store/modules/module/module";
import {actionTypes} from "../../../store/modules/module/createModule";*/

import { ref } from 'vue';


export default {
    name: "test",
 /*   data() {
        return {
            loading: false,
            description: '',
            modules: [],
            items: [
                {
                    label: 'Add',
                    icon: 'pi pi-pencil',
                    command: () => {
                        this.$toast.add({ severity: 'info', summary: 'Add', detail: 'Data Added' });
                    }
                },
                {
                    label: 'Update',
                    icon: 'pi pi-refresh',
                    command: () => {
                        this.$toast.add({ severity: 'success', summary: 'Update', detail: 'Data Updated' });
                    }
                },
                {
                    label: 'Delete',
                    icon: 'pi pi-trash',
                    command: () => {
                        this.$toast.add({ severity: 'error', summary: 'Delete', detail: 'Data Deleted' });
                    }
                },

            ]
        }
    },*/
    data() {
        return {
            products: null,
            productDialog: false,
            deleteProductDialog: false,
            deleteProductsDialog: false,
            product: {},
            selectedProducts: null,
            filters: {},
            submitted: false,
            statuses: [
                {label: 'INSTOCK', value: 'instock'},
                {label: 'LOWSTOCK', value: 'lowstock'},
                {label: 'OUTOFSTOCK', value: 'outofstock'}
            ],
            componentKey: 0,
        }
    },
    computed: {

    },
    components: {
        Toolbar,
        Button,
        FileUpload,
        DataTable,
        Column,
        ColumnGroup,
        InputText,
        Dialog,
        RadioButton,
        InputNumber,
        Textarea,
        Toast

    },
    productService: null,
    created() {
      /*  this.productService = new ProductService();*/
       this.getModules();
       this.initFilters();
    },
    mounted() {
        //this.productService.getProducts().then(data => this.products = data);
    },
    methods: {

        forceRerender() {
            this.componentKey += 1;
        },
     /*   formatCurrency(value) {
            if(value)
                return value.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
            return;
        },*/
        getModules() {
            this.loading = true;
            axios
                .get(`admin/modules`)
                .then(response => {

                    this.products = response.data.data;
                    //  this.modules = response.data.data;

                })
                .then(() => (this.loading = false));
        },
        openNew() {
            this.product = {};
            this.submitted = false;
            this.productDialog = true;
        },
        hideDialog() {
            this.productDialog = false;
            this.submitted = false;
        },
        saveProduct() {
            this.submitted = true;

            if (this.product.name.trim()) {
                console.log(this.product)
                if (this.product.id) {

                   // this.product.inventoryStatus = this.product.inventoryStatus.value ? this.product.inventoryStatus.value: this.product.inventoryStatus;

                    console.log('updatind save', this.product.id)
                    this.updateModule(this.product.id, this.product) .then((module) => (console.log('updated module', module)));;
                   // this.getModules();
                    this.products[this.findIndexById(this.product.id)] = this.product;
                    console.log('after upadating, all products', this.products)
                    this.forceRerender();
                    this.$toast.add({severity:'success', summary: 'Successful', detail: 'Product Updated', life: 3000});
                }
                else {
                   // this.product.id = this.createId();
                   // this.product.code = this.createId();
                   // this.product.image = 'product-placeholder.svg';
                   // this.product.inventoryStatus = this.product.inventoryStatus ? this.product.inventoryStatus.value : 'INSTOCK';
                    this.products.push(this.product);
                    this.storeModule(this.product)
                    this.getModules();
                    this.$toast.add({severity:'success', summary: 'Successful', detail: 'Product Created', life: 3000});
                }

                this.productDialog = false;
                this.product = {};
            }
        },
        editProduct(product) {
            this.product = {...product};
            console.log('slot edit', this.product)
            this.productDialog = true;
        },

        confirmDeleteProduct(product) {
            this.product = product;
            this.deleteProductDialog = true;
        },

        deleteProduct() {
            const productId = this.product.id;
            this.products = this.products.filter(val => val.id !== this.product.id);
            this.deleteProductDialog = false;
            this.product = {};
            this.destroyModule(productId);
            this.$toast.add({severity:'success', summary: 'Successful', detail: 'Product Deleted', life: 3000});
        },
        findIndexById(id) {
            let index = -1;
            for (let i = 0; i < this.products.length; i++) {
                if (this.products[i].id === id) {
                    index = i;
                    break;
                }
            }

            return index;
        },
        createId() {
            let id = '';
            var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            for ( var i = 0; i < 5; i++ ) {
                id += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return id;
        },
        exportCSV() {
            this.$refs.dt.exportCSV();
        },
        confirmDeleteSelected() {
            this.deleteProductsDialog = true;
        },
        deleteSelectedProducts() {
            this.products = this.products.filter(val => !this.selectedProducts.includes(val));
            this.deleteProductsDialog = false;
            console.log("selected", this.selectedProducts)
            const sorted = this.selectedProducts.map((product) => product['id']);
            console.log(sorted)
            this.selectedProducts = null;
            this.destroyModule(sorted);
            this.$toast.add({severity:'success', summary: 'Successful', detail: 'Products Deleted', life: 3000});

        },
        initFilters() {
            this.filters = {
                'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
            }
        },
        storeModule(moduleInput) {
            console.log('store Module', {moduleInput})
            this.$store.dispatch(actionTypes.createModule, {moduleInput})

                /*.then(module=> {

                    this.$router.push({name: 'admin.modules'})
                })*/
            //  console.log('onSubmit', data)
        },
        destroyModule(moduleId) {
            console.log('destroy Module', moduleId, actionTypes2)
          this.$store.dispatch(actionTypes2.removeModule, {moduleId})
         //  this.$store.dispatch(deleteModule, moduleId)

            /*.then(module=> {

                this.$router.push({name: 'admin.modules'})
            })*/
            //  console.log('onSubmit', data)
        },
        updateModule(id, moduleInput) {
            console.log('update Module', {moduleInput})
            return this.$store.dispatch(actionTypes3.updateModule, {id, moduleInput})

            /*.then(module=> {

                this.$router.push({name: 'admin.modules'})
            })*/
            //  console.log('onSubmit', data)
        }
       /* deleteArticle() {
            this.$store.dispatch(articleActionTypes.deleteArticle, {
                slug: this.$route.params.slug
            })
                .then(() => {
                    this.$router.push({name: 'globalFeed'})
                })
        }*/
    }
}
  /*  components: {
        SpeedDial
    },
    created() {
        this.loading = true;
        axios
            .get(`admin/modules`)
            .then(response => {

                this.modules = response.data.data;
                //this.description = response.data.exercises_description
            })
            .then(() => (this.loading = false));
    },*/

</script>

<style scoped>
.table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

@media screen and (max-width: 960px) {
    align-items: start;
}
}

.product-image {
    width: 100px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.p-dialog .product-image {
    width: 150px;
    margin: 0 auto 2rem auto;
    display: block;
}

.confirmation-content {
    display: flex;
    align-items: center;
    justify-content: center;
}

@media screen and (max-width: 960px) {
    :deep(.p-toolbar) {
        flex-wrap: wrap;

    .p-button {
        margin-bottom: 0.25rem;
    }
}
}
</style>
