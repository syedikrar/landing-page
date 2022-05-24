<template>
    <b-container fluid>
        <b-row>
            <b-col lg="12">
                <navbar :landing="landing"></navbar>
            </b-col>
            <b-col lg="12">
                <div class="iq-edit-list-data">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Edit Landing Page</h4>
                        </template>
                        <template v-slot:body>
                            <ValidationObserver ref="landingObserver" v-slot="{ errors }">
                                <form novalidate @submit.prevent="updateLandingPage">
                                    <b-row align-v="center">
                                        <b-form-group class="col-md-6" label="Name" label-for="name">
                                            <ValidationProvider name="name" rules="required" v-slot="{ errors }">
                                                <b-form-input v-model="landingForm.name" type="text"
                                                    placeholder="Name"
                                                    :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                            </ValidationProvider>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label-for="campaign" label="Campaign">
                                            <b-form-select plain v-model="landingForm.campaign_id" id="campagin">
                                                <template v-slot:first>
                                                    <b-form-select-option :value="null" disabled>Select campaign
                                                    </b-form-select-option>
                                                    <b-form-select-option v-for="campaign in campaigns"
                                                        :key="campaign.id" :value="campaign.id">{{campaign.name}}
                                                    </b-form-select-option>
                                                </template>
                                            </b-form-select>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label-for="country" label="Country">
                                            <b-form-select plain v-model="landingForm.country_id" id="country">
                                                <template v-slot:first>
                                                    <b-form-select-option :value="null" disabled>Select country
                                                    </b-form-select-option>
                                                    <b-form-select-option v-for="country in countries" :key="country.id"
                                                        :value="country.id">{{country.name}}</b-form-select-option>
                                                </template>
                                            </b-form-select>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label-for="type" label="Type">
                                            <b-form-select plain v-model="landingForm.type" :options="type" id="type">
                                                <template v-slot:first>
                                                    <b-form-select-option :value="null" disabled>Select campaign type
                                                    </b-form-select-option>
                                                </template>
                                            </b-form-select>
                                        </b-form-group>
                                    </b-row>
                                    <div class="text-right">
                                    <b-button type="submit" variant="primary" class="mr-2" :disabled="loader">
                                        Next <div v-if="loader"
                                            class="spinner-border spinner-border-sm text-secondary" role="status"></div>
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
import {core} from "../../config/pluginInit";
import VerticleLayout from "../../layouts/VerticleLayout";
import Navbar from "./Navbar";

export default {
    name: "ProfileEdit",
    layout: VerticleLayout,
    components: { Navbar },
    mounted() {
        core.index();
    },
    props: {
        campaigns: Array,
        templates: Array,
        countries: Array,
        landing: Object,
        selectedTemplate: Object
    },
    data() {
        return {
            loader: false,
            type: [{
                value: 'cpl',
                text: 'cpl'
            }, ],
            landingForm: this.landing,
            template_id: this.landing.template_id
        };
    },
    methods: {
        onSubmit() {},
        async updateLandingPage() {
            const isValid = await this.$refs.landingObserver.validate()
            if (isValid) {
                this.isLoading(true);
                this.$inertia.put(this.route('client.landing.update', this.landing.id), this.landingForm, {
                    onSuccess: () => {
                        core.showSnackbar("success", "Landing page has been updated successfully.&nbsp");
                        this.isLoading(false);
                    },
                    onError: () => {
                        this.isLoading(false);
                    },
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
