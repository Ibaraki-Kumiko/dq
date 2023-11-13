<template>
    <div>
        <div>
            <Message v-for="msg of messages" :severity="msg.severity" :key="msg.content">{{ msg.content }}</Message>

        </div>
        <ais-instant-search
            :search-client="searchClient"
            index-name="terms"
            class="container"
            :initial-ui-state="initialUiState"
        >


            <div class="row">
                <ais-configure
                    :hits-per-page.camel="10"
                    :enable-rules.camel="false">
                </ais-configure>

                <div class="search-block col-md-12 col-sm-12">
                    <ais-search-box
                        placeholder="Beginnen Sie zu tippen"
                        :autofocus="true"
                    >
                    </ais-search-box>


                    <ais-state-results>
                        <template v-slot="{ results: { hits, query } }">
                            <table class="table" v-if="query.length > 0 ">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <h1>
                                            Результаты для <b>{{ query }}</b>
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
                                                                 :to="'/dictionary/' + item.slug"


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
                                <tr v-else class="no-results">
                                    <td>Ничего не найдено по запросу: {{ query }}.</td>
                                </tr>
                            </table>
                            <div v-else class="no-results">
                            </div>
                        </template>
                    </ais-state-results>


                    <ais-pagination
                        class="pagination"
                        :show-first="false"
                        :show-previous="true"
                        :show-next="true"
                        :show-last="true"
                        :padding="2"

                        :total-pages="5"
                        :class-names="{
                         'ais-Pagination': 'MyCustomPagination',
                         'ais-Pagination-link': 'MyCustomLinkPagination'}"
                    >
                        <template
                            v-slot="{
                              currentRefinement,
                              nbPages,
                              nbHits,
                              pages,
                              isFirstPage,
                              isLastPage,
                              refine,
                              createURL,

                            }"
                        >


                            <ul class="ais-Pagination-list" v-show="showPagination">

                                <li v-if="!isFirstPage" class="ais-Pagination-item ">
                                    <a :href="createURL(0)" @click.prevent="refine(0)"
                                       class="ais-Pagination-link">
                                        ‹‹
                                    </a>
                                </li>
                                <li v-if="!isFirstPage" class="ais-Pagination-item ">
                                    <a
                                        :href="createURL(currentRefinement - 1)"
                                        @click.prevent="refine(currentRefinement - 1)"
                                        class="ais-Pagination-link"
                                    >
                                        ‹
                                    </a>
                                </li>
                                <li v-for="page in pages" :key="page"
                                    class="ais-Pagination-item ais-Pagination-item--page">
                                    <a
                                        :href="createURL(page)"
                                        :style="{ fontWeight: page === currentRefinement ? 'bold' : '' }"
                                        @click.prevent="refine(page)"
                                        class="ais-Pagination-link"
                                    >
                                        {{ page + 1 }}
                                    </a>
                                </li>
                                <li v-if="!isLastPage" class="ais-Pagination-item ">
                                    <a
                                        :href="createURL(currentRefinement + 1)"
                                        @click.prevent="refine(currentRefinement + 1)"
                                        class="ais-Pagination-link"
                                    >
                                        ›
                                    </a>
                                </li>
                                <li v-if="!isLastPage" class="ais-Pagination-item ">
                                    <a :href="createURL(nbPages)" @click.prevent="refine(nbPages)"
                                       class="ais-Pagination-link">
                                        ››
                                    </a>
                                </li>
                            </ul>
                        </template>
                    </ais-pagination>
                    <ais-stats>
                        <template v-slot="{ nbHits, page, nbPages, query }">
                             {{getResultText(nbHits, page, nbPages, query)}}
                        </template>
                    </ais-stats>


                </div>

            </div>


        </ais-instant-search>
    </div>

</template>

<script>
import Message from 'primevue/message';

import Breadcrumbs from '../components/shared/Breadcrumbs';
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
        Breadcrumbs,
        Message,

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
            showPagination: false,
            showResults: false,
            searchClient: algoliasearch(
                process.env.MIX_ALGOLIA_APP_ID,
                process.env.MIX_ALGOLIA_API_KEY
            ),

            searchFunction({uiState, setUiState}) {


            },
            initialUiState: {
                terms: {
                    query: 'ab',
                    page: 1,
                },
            },


            messages: [
                {severity: 'info', content: 'This is a demo version that contains only 300 words starting with "A"'},

            ]

        };

    },
    mounted() {

    },
    methods: {
        getResultText(nbHits, page, nbPages, query) {
            this.showPagination = query !== "";

        }

    }

}
</script>

<style>


.vignette__label {
    font-weight: 400;
    font-family: Px, cv-linear, l, monospace;
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
