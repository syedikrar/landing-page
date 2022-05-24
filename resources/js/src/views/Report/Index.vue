<template>
    <b-container fluid>
        <vue-confirm-dialog class="confirm-dialog-custom"></vue-confirm-dialog>
        <b-row>
            <b-col lg="12">
                <iq-card>
                    <template v-slot:headerTitle v-if="landings.data.length ">
                        <h4 class="card-title">Landing Pages Report</h4>
                        <div v-if="$page.props.flash.error" class="text-danger">
                            {{ $page.props.flash.error }}
                        </div>
                    </template>
                    <template v-slot:headerAction v-if="landings.data.length ">
                        <b-form-group label="" label-for="filter-input"  label-align-sm="right"
                            label-size="sm" class="mb-0 iq-search-bar w-350">
                            <b-input-group size="sm">
                                <b-form-input id="filter-input" v-model="filter" type="search"
                                    placeholder="Type to Search" class="search-input"></b-form-input>
                            </b-input-group>
                        </b-form-group>
                       
                    </template>
                    <template v-slot:body v-if="landings.data.length ">
                        <b-table responsive :items="landings.data" :fields="fields" :sort-by.sync="sortBy"
                            :sort-desc.sync="sortDesc" sort-icon-left :filter="filter"
                            :filter-included-fields="filterOn" class="mb-0 table-borderlesss">
                        </b-table>
                        <pagination class="mt-6" :links="landings.links" />
                    </template>
                    <template v-slot:body v-else>
                        <div class="text-center">
                            <img :src="require('../../assets/images/landing-page-animate.svg')" class="img-fluid mb-0"
                                alt="logo" width="360px">
                            <h2 class="mb-3 mt-0">Hi, Let's create your first landing page!</h2>
                            <inertia-link :href="route('client.landing.create')">
                                <b-button class="mb-3" variant="primary" v-if="checkUserPermissions('add_landings')">Get
                                    Started</b-button>
                            </inertia-link>
                        </div>
                    </template>
                </iq-card>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
import {
    core
} from "../../config/pluginInit";
import VerticleLayout from "../../layouts/VerticleLayout";
import Pagination from '../Shared/Pagination'

export default {
    components: {
        pagination: Pagination
    },
    name: "Index",
    layout: VerticleLayout,

    mounted() {
        core.index();
    },
    props: {
        landings: Object,
         campaigns: Array,
    },
    data() {
        return {
            checked: false,
            searchForm: {
                name: null,
                domain: '',
                country_id: null,
                campaign_id: null,
                template_id: 0,
                type: null,
            },
            sortBy: 'id',
            sortDesc: true,
            filter: null,
            permissionsArray: this.$page.props.auth.user.permissions,
            filterOn: [],
            fields: [
                {
                    key: 'name',
                    label: 'Landing Page',
                    sortable: true
                },
                {
                    key: 'campaign',
                    label: 'Campaign',
                    sortable: true
                },
                {
                    key: 'views',
                    label: 'Views',
                    sortable: true
                },
                {
                    key: 'entries',
                    label: 'Form Entries',
                    sortable: true
                },
                {
                    key: 'valid_leads',
                    label: 'Valid Leads',
                    sortable: true
                },
                {
                    key: 'invalid_leads',
                    label: 'Invalid Leads',
                    sortable: true
                },
                {
                    key: 'api_errors',
                    label: 'API Errors',
                    sortable: true
                },
               
            ],
        };
    },
    methods: { 
        checkUserPermissions(value) {
            return this.permissionsArray.includes(value);
        },
    }
}
</script>

