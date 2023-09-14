<template>
    <ais-instant-search
        :search-client="searchClient"
        index-name="terms"
        class="container"
        :search-function="searchFunction"
    >
        <div class="row">
            <ais-configure
                :hits-per-page.camel="10"
                :enable-rules.camel="false">

                <template v-slot="{ searchParameters, refine }" @loadstart
                    ="refine({
        ...searchParameters,
        enableRules: !searchParameters.enableRules,
      })">

                </template>
            </ais-configure>



            <div class="search-block col-md-12 col-sm-12">
                <ais-search-box
                    placeholder=""
                    :autofocus="true"
                    show-loading-indicator
                    reset-title="Remove the query"
                >


                </ais-search-box>

                <ais-state-results >
                    <template v-slot="{ results: { hits, query } }">

                        <table class="table" v-if="query.length > 0 ">

                            <thead >
                            <tr>
                                <th scope="col">
                                    <h1>
                                        Результаты для <b>{{query}}</b>
                                    </h1>

                                </th>
                            </tr>
                            </thead>
                            <ais-hits class="table-caption" v-if="hits.length > 0">
                                <template v-slot="{items}">
                                    <tr v-for="item in items" :key="item.objectID">
                                        <td @click="sendEvent(items)">
                                            <div class="vignette__label">
                                                <router-link class="phrase_link"
                                                             :to="'/dictionary/' + item.term"


                                                >
                                                    <ais-highlight
                                                        attribute="term"
                                                        :hit="item"
                                                        highlighted-tag-name="em"
                                                    />
                                                </router-link>
                                            </div>

                                        </td>

                                    </tr>
                                </template>
                            </ais-hits>
                            <tr  v-else class="no-results">
                                <td>Ничего не найдено по запросу: {{ query }}.</td>
                            </tr>
                        </table>
                        <div v-else class="no-results">
                        </div>
                    </template>
                </ais-state-results>

                <ais-pagination
                    class="pagination"
                    :show-first="true"
                    :show-previous="true"
                    :show-next="true"
                    :show-last="true"
                    :padding="2"
                    :class-names="{
                         'ais-Pagination': 'MyCustomPagination',
                         'ais-Pagination-link': 'MyCustomLinkPagination'
                    }"
                />

            </div>

        </div>


    </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';
import 'instantsearch.css/themes/satellite-min.css';
import {
    AisInstantSearch,
    AisSearchBox,
    AisConfigure,
    AisHighlight,
    AisPagination,
    AisToggleRefinement,
    AisStats,
    AisPanel,
    AisStateResults,
    AisRefinementList,
    AisHits
} from 'vue-instantsearch';

export default {
    name: "SearchForm",
    components: {
        AisInstantSearch,
        AisSearchBox,
        AisConfigure,
        AisHighlight,
        AisPagination,
        AisToggleRefinement,
        AisStats,
        AisPanel,
        AisStateResults,
        AisRefinementList,
        AisHits
    },
    data() {
        return {
            showResults: false,
            searchClient: algoliasearch(
                process.env.MIX_ALGOLIA_APP_ID,
                process.env.MIX_ALGOLIA_API_KEY
            ),

            searchFunction(helper) {
                if (helper.state.query) {
                    helper.search();
                }
                if (helper.state.query=== '') {
                    helper.search();

                }


               helper.search()

            },
            defaultFac:
                {
                    "count": 4,
                    "isRefined": false,
                    "value": "vulgar",
                    "label": "vulgar",
                    "highlighted": "vulgar"
                }

        };

    },
    mounted() {
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {

                this.$nextTick(() => {
                })

            }
        }

    },

    methods: {
        sendEvent(item) {
        },

    }

}
</script>

<style>


.vignette__label {
    font-weight: 400;
    font-family: Px,cv-linear,l,monospace;
    background: #04cba0;
    text-decoration: none;
    font-size: 22px;
    border-radius: 5px;
    display: inline-block;
    line-height: 1.2;
    padding: 9px 15px
}


.search-block {


    margin-bottom: 20px;
}

.filters {
    border: 1px solid #d6d6e7;
    padding: 10px 10px;
    border-radius: 3px;
    margin-bottom: 20px;
}

.pagination {
    margin-top: 20px;
    width: 100%;
    align-self: stretch;
}

.MyCustomLinkPagination {

    background-color: #8ab029;
}


.MyCustomLinkPagination:hover {
    color: #54f1d2;
}

.table-caption {
    display: table-header-group;
}

.phrase_link {
    text-decoration: none;
    color: #2c3034;
}

.phrase_link:hover {
    text-decoration: none;
    color: #42b883;
}

.table {
    margin-top: 50px;
}

.no-results {
    margin-top: 50px;
}

.ais-RefinementList-count {
    margin-left: 0.1rem;
}

.ais-RefinementList.disabled {
    color: grey;
}

.clicks-disabled {
    pointer-events: none;
    cursor: default;
    color: grey;
}
.ais-SearchBox {

    align-items: center;
    justify-content: center;
    display: flex;
    border-radius: 7px;
    background-color: #04c89d;
    height: 100px;
}
.ais-SearchBox-form {
    margin: 0 17px 0 17px;
    border-radius: 3px;
    height: 60px;
}

.ais-SearchBox-input:focus {
    border-color: #299c83;

}
.ais-SearchBox-input {
    font-size: 30px;
    font-weight: bold;

}
</style>
