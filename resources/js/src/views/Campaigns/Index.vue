<template>
    <b-container fluid>
        <vue-confirm-dialog class="confirm-dialog-custom"></vue-confirm-dialog>
        <div class="row">
            <div class="col-md-12">
                <b-row>
                    <b-col cols="12 text-right">
                        <b-button class=" mb-4" variant="primary" @click="showModal('create')" v-if="campaigns.data.length && checkUserPermissions('add_campaigns')">New Campaign</b-button>


                        <b-modal id="campaign" centered :title="campaign.id != null ? 'Update Campaign' : 'Create Campaign'" hide-footer>
                            <ValidationObserver ref="campaignObserver" v-slot="{ invalid }">
                                <b-form @submit.prevent="submitForm(campaign)" ref='createCampaignForm'>
                                    <b-form-group label="Name">
                                        <ValidationProvider name="Name" rules="required" v-slot="{ errors }">
                                            <b-input v-model="campaign.name" type="text" :class="(errors.length > 0 ? ' is-invalid' : '')">
                                            </b-input>
                                            <div class="invalid-feedback">
                                                <span>{{ errors[0] }}</span>
                                            </div>
                                            <div class="invalid-feedback d-block" v-if="$props.errors.campaignErrors">
                                                <span>{{ $props.errors.campaignErrors.name  }}</span>
                                            </div>
                                        </ValidationProvider>
                                    </b-form-group>
                                    <div class="d-flex justify-content-end">
                                        <b-button variant=" iq-bg-primary" class="iq-waves-effect" @click="closeModal()">Cancel</b-button>
                                        <b-button variant="primary ml-2" class="iq-waves-effect" type="submit" :disabled="invalid || loader">
                                            {{ campaign.id ? 'Update' : 'Submit' }}
                                            <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                        </b-button>
                                    </div>
                                </b-form>
                            </ValidationObserver>
                        </b-modal>

                        <b-modal id="testimonial" centered title="Please Submit Your Review" hide-footer>
                            <ValidationObserver ref="testimonialObserver" v-slot="{ invalid }">
                                <b-form @submit.prevent="submitTestimonial(testimonial)" ref='createTestimonialForm'>
                                    <b-form-group label="Name">
                                        <ValidationProvider name="description" rules="required" v-slot="{ errors }">
                                            <b-form-textarea
                                                id="textarea"
                                                v-model="description"
                                                placeholder="Enter description..."
                                                rows="3"
                                                max-rows="6"
                                                ></b-form-textarea>
                                            <div class="invalid-feedback">
                                                <span>{{ errors[0] }}</span>
                                            </div>
                                            <div class="invalid-feedback d-block" v-if="$props.errors.testimonialErrors">
                                                <span>{{ $props.errors.testimonialErrors.description  }}</span>
                                            </div>
                                        </ValidationProvider>
                                    </b-form-group>
                                    <div class="d-flex justify-content-end">
                                        <b-button variant=" iq-bg-primary" class="iq-waves-effect" @click="closeModal()">Cancel</b-button>
                                        <b-button variant="primary ml-2" class="iq-waves-effect" type="submit" :disabled="invalid || loader">
                                            {{ 'Add Review' }}
                                            <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                        </b-button>
                                    </div>
                                </b-form>
                            </ValidationObserver>
                        </b-modal>


                    </b-col>
                </b-row>
                <b-row>
                    <b-col lg="12">
                        <iq-card>
                            <template v-slot:headerTitle v-if="campaigns.data.length ">
                                <h4 class="card-title">Campaigns</h4>
                                <div v-if="$page.props.flash.error" class="text-danger">
                                    {{ $page.props.flash.error }}
                                </div>
                            </template>
                            <template v-slot:headerAction v-if="campaigns.data.length ">
                                <b-form-group
                                label-for="filter-input"
                                label-cols-sm="2"
                                label-align-sm="right"
                                label-size="sm"
                                class="mb-0 iq-search-bar w-350"
                                >
                                    <b-input-group size="sm">
                                        <b-form-input
                                        id="filter-input"
                                        v-model="filter"
                                        type="search"
                                        placeholder="Type to Search"
                                        class="search-input"
                                        ></b-form-input>

                                    </b-input-group>
                                </b-form-group>
                            </template>
                            <template v-slot:body v-if="campaigns.data.length ">
                                <b-table responsive :items="campaigns.data"  :fields="fields"
                                :sort-by.sync="sortBy" 
                                :sort-asc.sync="sortAsc" sort-icon-left  :filter="filter"
                                :filter-included-fields="filterOn"
                                class="mb-0 table-borderlesss">
                                    <template v-slot:cell(actions)="data">
                                        <button type="button" @click="showRejectionReason(data.item)" class="btn btn-default text-danger px-1" v-if="data.item.status == 'rejected'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button v-b-tooltip.hover.bottomleft title="Edit Campaign" type="button" class="btn btn-default text-success px-1" v-if="checkUserPermissions('edit_campaigns')">
                                            <i class="fa fa-pen" v-b-modal.campaign @click="editCampaign(data)" />
                                        </button>
                                        <button v-b-tooltip.hover.bottomleft title="Delete Campaign" type="button" @click="handleClick(data.item, 'delete')" class="btn btn-default text-danger px-1" v-if="checkUserPermissions('delete_campaigns')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <b-form-checkbox v-if="data.item.status == 'active' | data.item.status == 'inactive'" 
                                        class="d-inline-block align-middle" 
                                        :checked="data.item.status == 'active' ? true : false" 
                                        :name="'check-button'+data.item.id " 
                                        :id="'switch'+data.item.id" switch  
                                        @change="handleClick(data.item, 'changeStatus', $event)"
                                        v-b-tooltip.hover.bottomleft title="Change Status"
                                        ></b-form-checkbox>
                                    </template>
                                    <template v-slot:cell(status)="data">
                                        <b-badge pill :variant="data.item.status == 'active' ? 'success' : 'danger'">{{ data.item.status }}</b-badge>
                                    </template>
                                    <template v-slot:cell(landings)="data">
                                        <inertia-link :href="route('client.landing.index',{campaign:data.item.id})">{{ data.item.landings }}</inertia-link>
                                    </template>
                                </b-table>
                                <pagination class="mt-6" :links="campaigns.links" />

                            </template>
                            <template v-slot:body v-else>
                                <div class="text-center">
                                    <img :src="require('../../assets/images/email-campaign-animate.svg')" class="img-fluid mb-0" alt="logo" width="360px">
                                    
                                    <h2 class="mb-3 mt-0">Hi, Let's create your first campaign!</h2>
                                    <b-button class="mb-3" variant="primary" v-if="checkUserPermissions('add_campaigns')" @click="showModal('create')">Get Started</b-button>
                                    </div>
                            </template>
                        </iq-card>
                    </b-col>
                </b-row>
            </div>
        </div>
    </b-container>
</template>

<script>
    import { core } from "../../config/pluginInit";
    import VerticleLayout from "../../layouts/VerticleLayout";
    import { ValidationProvider, extend } from 'vee-validate';
    import { required } from 'vee-validate/dist/rules';
    import Pagination from '../Shared/Pagination'


    extend('required', {
        ...required,
        message: 'This field is required'
    });

    export default {
        name: "Index",
        layout: VerticleLayout,
        mounted() {
            core.index();
        },
        props:{
            campaigns:Object,
            errors:Object,
            testimonial_count:Number,
        },
        data() {
            return {
                loader: false,
                sortBy: 'id',
                sortAsc: true,
                filter: null,
                hasAccess: false,
                permissionsArray: this.$page.props.auth.user.permissions,
                filterOn: [],
                testimonial : [],
                description : '',
                campaign: this.defaultCampaign(),
                fields: [
                    { key: 'name', label: 'Name' , sortable: true},
                    { key: 'code', label: 'Code' , sortable: true},
                    { key: 'landings', label: 'Landings', sortable: true},
                    { key: 'status'},
                    { key: 'created_at', label: 'Created At' , sortable: true},
                    { key: "actions" }
                ],
            }
        },
        methods: {
            	onChange(e){
		},
            closeModal() {
                this.$bvModal.hide('campaign')
                this.campaign.name = '';
                this.campaign.id = null;
                requestAnimationFrame(() => {
                    this.$refs.campaignObserver.reset();
                })
            },

            showModal(type) {
                if (type == 'create') {
                    this.campaign.name = '';
                    this.campaign.id = null;
                }
                this.$bvModal.show('campaign')
            },

            defaultCampaign () {
                return {
                    id: null,
                    name: '',
                    status: 'active'
                }
            },

            submitForm (campaign) {
                if (campaign.id) {
                    this.updateCampaign(campaign)
                } else {
                    this.saveCampaign(campaign)
                }
            },

            async saveCampaign (campaign) {
                this.isLoading(true)
                this.$inertia.post(this.route('client.campaigns.store'), campaign, {
                    onSuccess: () => {
                        // if(this.$page.props.campaigns.total > 2){
                        //     if( this.$props.testimonial_count < 1){
                        //         this.$bvModal.show('testimonial')
                        //     }
                        // }

                        if (!this.$page.props.flash.error) {
                        core.showSnackbar("success", "Campaign added successfully.&nbsp");
                         }
                        this.closeModal();
                        this.isLoading(false);
                    },
                    onError: () => {
                        this.isLoading(false)
                    },
                    errorBag: 'campaignErrors'
                });
            },

            editCampaign (campaign) {
                this.campaign = {...campaign.item};
            },

            async updateCampaign (campaign) {
                this.isLoading(true)
                this.$inertia.put(this.route('client.campaigns.update', campaign.id), campaign, {
                    onSuccess: () => {
                        core.showSnackbar("success", "Campaign updated successfully.&nbsp");
                        this.campaign = this.defaultCampaign();
                        this.closeModal();
                        this.isLoading(false)
                    },
                    onError: () => {
                        this.isLoading(false)
                    },
                    errorBag: 'campaignErrors'
                });
            },

            deleteCampaign (campaign) {
                this.$inertia.delete(this.route('client.campaigns.destroy', campaign.id))
                core.showSnackbar("success", "Landing has been deleted successfully.&nbsp");
            },

            async submitTestimonial (testimonial){
                 this.isLoading(true)
                this.$inertia.post(this.route('client.testimonials.store'), {'description' : this.description}, {
                    onSuccess: () => {
                         if (!this.$page.props.flash.error) {
                        core.showSnackbar("success", "Review added successfully.&nbsp");
                         }
                        requestAnimationFrame(() => {
                            this.$refs.testimonialObserver.reset();
                        })
                        this.$bvModal.hide('testimonial');
                        this.description = '';
                        this.isLoading(false);
                    },
                    onError: () => {
                        this.isLoading(false)
                    },
                    errorBag: 'testimonialErrors'
                });
            },
            isLoading(value) {
                this.loader = value;
            },

            checkUserPermissions(value) {
                return this.permissionsArray.includes(value);
            },

            changeStatus(event, campaign) {
                this.$inertia.put(this.route('client.campaign.status', campaign.id), [
                    event ? 'active' : 'inactive'
                ], {
                    onSuccess: () => {
                        if (!this.$page.props.flash.error) {
                            core.showSnackbar("success", "Campaign status updated successfully.&nbsp");
                        }
                    }
                })
            },

            showRejectionReason(campaign) {
                this.$confirm(
                    {
                        title: 'Rejection Reason:',
                        message: campaign.rejection_reason,
                        button: {
                            no: 'Cancel'
                        },
                    }
                )
            },

            handleClick(campaign, type, event = null){
                if (type == 'delete') {
                    var message = "Are you sure you wan't to delete this campaign. This action is undoable, all the related landing pages will be deleted as well.";
                } else {
                    var message = "Are you sure you wan't to change the status of this campaign. This action will be applicable on all the related landing pages.";
                }
                this.$confirm(
                    {
                        title: 'Are you sure you?',
                        message: message,
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
                                type == 'delete'
                                    ? this.deleteCampaign(campaign)
                                    : this.changeStatus(event, campaign)
                            } else {
                                
                            }
                        },
                    }
                )
            }
        },
        components: {
            ValidationProvider,
            pagination: Pagination
        },
    }
</script>
