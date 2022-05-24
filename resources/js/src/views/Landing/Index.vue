<template>
    <b-container fluid>
        <vue-confirm-dialog class="confirm-dialog-custom"></vue-confirm-dialog>
        <b-row>
            <b-col cols="12 text-right mb-4" v-if="landings.data.length && checkUserPermissions('add_landings')">
                <inertia-link :href="route('client.landing.create')" class="text-center my-3">
                    <b-button variant="primary" v-b-tooltip.hover title="Add New Landing">New Landing</b-button>
                </inertia-link>
            </b-col>
            <b-col lg="12">
                <iq-card>
                    <template v-slot:headerTitle v-if="landings.data.length ">
                        <h4 class="card-title">Landing Pages </h4>
                        <div v-if="$page.props.flash.error" class="text-danger">
                            {{ $page.props.flash.error }}
                        </div>
                    </template>
                    <template v-slot:headerAction v-if="landings.data.length ">
                        <b-form-group label="" label-for="filter-input" label-cols-sm="2" label-align-sm="right"
                            label-size="sm" class="mb-0 iq-search-bar w-350">
                            <b-input-group size="sm">
                                <b-form-input id="filter-input" v-model="filter" type="search"
                                    placeholder="Type to Search" class="search-input"></b-form-input>
                            </b-input-group>
                        </b-form-group>
                    </template>
                    <template v-slot:body v-if="landings.data.length ">
                        <b-table responsive :items="landings.data" :fields="fields" :sort-by.sync="sortBy"
                            :sort-desc.sync="sortDesc" sort-icon-left :filter="filter" ref="table"
                            :filter-included-fields="filterOn" class="mb-0 table-borderlesss">
                            <template v-slot:cell(name)="data"> <h5><strong> {{ data.item.name }}</strong>
                                <inertia-link :href="route('client.landing.select_template', data.item.id)" class="text-danger small-text" v-if="!data.item.template_id"> * Next Step: Select a template for the landing page</inertia-link>
                                <inertia-link :href="route('client.forms.show', data.item.form_id)" class="text-danger small-text" v-else-if="!data.item.form_step"> * Next Step: Update the landing page form</inertia-link>
                                <a :href="route('client.landing.edit_template', data.item.id)" target="_blank" class="text-danger small-text" v-else-if="!data.item.page_template_updated"> * Next Step: Update page with visual editor</a>
                                <a :href="route('client.landing.edit_thankyou_page', data.item.id)" target="_blank" class="text-danger small-text" v-else-if="!data.item.thankyou_page_updated"> * Next Step: Update Thank You page with visual editor</a>
                                <span class="text-danger small-text"  v-else-if="data.item.status == 'inactive'"> * Deployed, Inactive</span>
                                <span class="text-success small-text" v-else><i class="fa fa-check"></i> Successfully Deployed</span></h5>
                            </template>
                            <template v-slot:cell(status)="data">
                                <b-badge pill :variant="data.item.status == 'active' ? 'success' : 'danger'">{{ data.item.status }}</b-badge>
                            </template>
                            <template v-slot:cell(actions)="data">
                                <a :href="route('client.landing.show',data.item.uuid)" target="_blank"
                                    class="btn btn-default text-primary px-1" v-if="checkUserPermissions('view_landings') && data.item.template" v-b-tooltip.hover.bottomright="'View Landing'">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <inertia-link :href="route('client.landing.edit', data.item.id)" v-if="checkUserPermissions('edit_landings') " v-b-tooltip.hover.bottomright="'Edit Landing'">
                                    <button type="button" data-action-type="edit"
                                        class="btn btn-default text-success px-1">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                </inertia-link>
                                <a :href="route('client.landing.edit_template', data.item.id)" target="_blank" v-if="checkUserPermissions('edit_landings') " v-b-tooltip.hover.bottomright="'Visual Page Editor'">
                                    <button type="button" data-action-type="edit"
                                        class="btn btn-default text-success px-1">
                                        <i class="fa fa-paint-brush"></i>
                                    </button>
                                </a>
                               
                                <button type="button" @click="showRejectionReason(data.item)" class="btn btn-default text-danger px-1" v-if="data.item.status == 'rejected'" v-b-tooltip.hover.bottomright="'Change Status'">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                                <button type="button" @click="sendRequest(data.item.id)" class="btn btn-default text-danger px-1" v-if="data.item.status == 'rejected'" title="Submit request">
                                    <i class="fa fa-comment"></i>
                                </button>
                                <button type="button" :attr="data.item.id" @click="handleClick(data.item.id)" data-action-type="remove" class="btn btn-default text-danger px-1" v-if="checkUserPermissions('delete_landings')" v-b-tooltip.hover.bottomright="'Delete Landing'">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <b-form-checkbox 
                                v-if="data.item.template_id" 
                                class="d-inline-block align-middle" 
                                :checked="data.item.status == 'active' ? true : false" 
                                :name="'check-button'+data.item.id " 
                                :id="'switch'+data.item.id" switch 
                                @change="check($event,data.item.id)"></b-form-checkbox>
                            </template>
                            <template v-slot:cell(template)="data">
                                <a :href="'/' +data.item.template_preview_url" target="_blank">{{ data.item.template}}</a>
                            </template>
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
    name: "UserList",
    layout: VerticleLayout,

    mounted() {
        core.index();
    },
    props: {
        landings: Object
    },
    $refs: {
        table: HTMLElement
    },
    data() {
        return {
            checked: false,
            sortBy: 'id',
            sortDesc: true,
            filter: null,
            permissionsArray: this.$page.props.auth.user.permissions,
            filterOn: [],
            fields: [
                {
                    key: 'name',
                    label: 'Name',
                    sortable: true
                },
                {
                    key: 'campaign',
                    label: 'Campaign',
                    sortable: true
                },
                {
                    key: 'template',
                    label: 'Template',
                    sortable: true
                },
                {
                    key: 'country',
                    label: 'Country',
                    sortable: true
                },
                {
                    key: 'domain',
                    label: 'Domain',
                    sortable: true
                },
                {
                    key: 'status',
                    sortable: true
                },
                {
                    key: "actions",
                    sortable: false
                }
            ],
        };
    },
    methods: {
        removeData(id) {
            this.$inertia.delete(this.route('client.landing.destroy', id))
            core.showSnackbar("success", "Landing has been deleted successfully.");
        },
        checkUserPermissions(value) {
            return this.permissionsArray.includes(value);
        },
        check(event, id) {
            this.$inertia.put(this.route('client.landing.update_status', id), [event ? 'active' : 'inactive'], {
                onSuccess: () => {
                    if (!this.$page.props.flash.error) {
                        core.showSnackbar("success", "Landing status updated successfully.&nbsp");
                    }
                    else{
                        document.querySelector('#switch'+id).checked = false
                    }
                },
                onError: () => {
                    core.showSnackbar("error", "Can't change the status of landing until campaign is active.&nbsp");
                    document.querySelector('#switch'+id).checked = false
            
                }
            })
        },

        showRejectionReason(landing) {
            this.$confirm(
                {
                    title: 'Rejection Reason:',
                    message: landing.rejection_reason,
                    button: {
                        no: 'Cancel'
                    },
                }
            )
        },

        handleClick(id) {
            this.$confirm(
                {
                    title: 'Are you sure you?',
                    message: "Are you sure you wan't to delete this landing. This action is undoable",
                    button: {
                        yes: 'Yes',
                        no: 'Cancel'
                    },
                    /**
                     * Callback Function
                     * @param {Boolean} confirm 
                     */
                    callback: confirm => {
                        if (confirm) {
                            this.removeData(id);
                        } else {
                            
                        }
                    },
                }
            )
        },

        sendRequest(id) {
            this.$inertia.put(this.route('client.landing.set_status', id), ['requested'], {
                onSuccess: () => {
                    core.showSnackbar("success", "Request has been sent to admin.&nbsp");
                },
                onError: () => {
                    core.showSnackbar("error", "Can't change the status of landing until campaign is active.&nbsp");
                }
            })
        }
    }
}
</script>