<template>
    <b-container fluid>
        <b-row>
            <b-col lg="12">
                <iq-card body-class="p-0">
                    <ul id="myTab" class="iq-edit-profile d-flex nav nav-pills">
                        <li class="col-md-2 p-0 nav-item">
                            <a id="myTab" data-toggle="tab" href="#landing-information" role="tab"
                                aria-controls="tabpanel" class="nav-link  show active">
                                1. Information
                            </a>
                        </li>
                        <li class="col-md-2 p-0 nav-item  nav-disabled">
                            <a id="myTab" data-toggle="tab" href="#" role="tab" aria-controls="tabpanel"
                                class="nav-link">
                                2. Template
                            </a>
                        </li>
                         <li class="col-md-2 p-0 nav-item  nav-disabled">
                            <a id="myTab" data-toggle="tab" href="#" role="tab" aria-controls="tabpanel"
                                class="nav-link">
                                3. Form
                            </a>
                        </li>
                        <li class="col-md-2 p-0 nav-item  nav-disabled">
                            <a id="myTab" data-toggle="tab" href="#" role="tab" aria-controls="tabpanel"
                                class="nav-link">
                                4. Tracking
                            </a>
                        </li>
                        <li class="col-md-2 p-0 nav-item  nav-disabled">
                            <a id="myTab" data-toggle="tab" href="#" role="tab" aria-controls="tabpanel"
                                class="nav-link">
                                5. Domain
                            </a>
                        </li>
                        
                        <li class="col-md-2 p-0 nav-item  nav-disabled">
                            <a id="myTab" data-toggle="tab" href="#" role="tab" aria-controls="tabpanel"
                                class="nav-link">
                               6. Publish
                            </a>
                        </li>
                       
                       
                    </ul>
                </iq-card>
            </b-col>
            <b-col lg="12">
                <div class="iq-edit-list-data">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Create Landing Page</h4>
                        </template>
                        <template v-slot:body>
                            <ValidationObserver ref="landingObserver" >
                                <form novalidate @submit.prevent="createLandingPage">
                                    <b-row align-v="center">
                                        <b-form-group class="col-md-6" label-for="Name" label="Name">
                                            <ValidationProvider name="Name" rules="required" v-slot="{ errors }">
                                                <b-form-input v-model="landingForm.name" type="text"
                                                    placeholder="Name"
                                                    :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                                <div class="invalid-feedback d-block"
                                                    v-if=" $page.props.errors.checkLanding">
                                                    {{ $page.props.errors.checkLanding.name }}
                                                </div>
                                            </ValidationProvider>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label-for="campaign" label="Campaign">
                                            <ValidationProvider name="Campagin" rules="required" v-slot="{ errors }">
                                                <b-form-select plain v-model="landingForm.campaign_id" id="campagin"
                                                    :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                    <template v-slot:first>
                                                        <b-form-select-option :value="null">Select campaign
                                                        </b-form-select-option>
                                                        <b-form-select-option v-for="campaign in campaigns"
                                                            :key="campaign.id" :value="campaign.id">{{campaign.name}}
                                                        </b-form-select-option>
                                                    </template>
                                                </b-form-select>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                                <div class="invalid-feedback d-block"
                                                    v-if=" $page.props.errors.checkLanding">
                                                    {{ $page.props.errors.checkLanding.campaign_id }}</div>
                                            </ValidationProvider>
                                        </b-form-group>

                                        <b-form-group class="col-md-6" label-for="country" label="Country">
                                            <ValidationProvider name="Country" rules="required" v-slot="{ errors }">
                                                <b-form-select plain v-model="landingForm.country_id" id="country"
                                                    :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                    <template v-slot:first>
                                                        <b-form-select-option :value="null">Select country
                                                        </b-form-select-option>
                                                        <b-form-select-option v-for="country in countries"
                                                            :key="country.id" :value="country.id">{{country.name}}
                                                        </b-form-select-option>
                                                    </template>
                                                </b-form-select>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                                <div class="invalid-feedback d-block"
                                                    v-if=" $page.props.errors.checkLanding">
                                                    {{ $page.props.errors.checkLanding.country_id }}</div>
                                            </ValidationProvider>
                                        </b-form-group>

                                        <b-form-group class="col-md-6" label-for="type" label="Type">
                                            <ValidationProvider name="Type" rules="required" v-slot="{ errors }">
                                                <b-form-select plain v-model="landingForm.type" :options="type"
                                                    id="type" :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                    <template v-slot:first>
                                                        <b-form-select-option :value="null">Select campaign type
                                                        </b-form-select-option>
                                                    </template>
                                                </b-form-select>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                                <div class="invalid-feedback d-block"
                                                    v-if=" $page.props.errors.checkLanding">
                                                    {{ $page.props.errors.checkLanding.type }}</div>
                                            </ValidationProvider>
                                        </b-form-group>
                                    </b-row>
                                    <div class="text-right">
                                        <b-button type="submit" variant="primary" class="mr-2" :disabled="loader">
                                            Next <div v-if="loader" class="spinner-border spinner-border-sm text-secondary"
                                                role="status"></div>
                                        </b-button>
                                    </div>
                                </form>
                            </ValidationObserver>
                        </template>
                    </iq-card>
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
import {
    core
} from "../../config/pluginInit";
import VerticleLayout from "../../layouts/VerticleLayout";


export default {
    name: "ProfileEdit",
    layout: VerticleLayout,
    mounted() {
        core.index();
    },
    props: {
        campaigns: Array,
        templates: Array,
        countries: Array,
        errors: Object
    },
    data() {
        return {
            loader: false,
            type: [{
                value: 'cpl',
                text: 'cpl'
            }, ],
            landingForm: {
                name: null,
                domain: '',
                country_id: null,
                campaign_id: null,
                template_id: 0,
                type: null,
            },
        };
    },
    methods: {
        async createLandingPage() {
            const isValid = await this.$refs.landingObserver.validate()
            if (isValid) {
                this.isLoading(true)
                this.$inertia.post(this.route('client.landing.store'), this.landingForm, {
                    onSuccess: () => { this.isLoading(false) },
                    onError: () => { this.isLoading(false) },
                    errorBag: 'checkLanding',
                })
            }
        },
        
        isLoading(value) {
            this.loader = value;
        }
    }
}
</script>
