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
                            <h4 class="card-title">Domain Information</h4>
                        </template>
                        <template v-slot:body>
                            <ValidationObserver ref="landingObserver">
                                <form novalidate @submit.prevent="updateLandingPage" >
                                    <b-row> 
                                        <b-col lg="12">
                                            <b-form-group  label="URL for the landing page">
                                                <b-row> 
                                                    <b-col lg="12">
                                                        <a :href="genUrl" target="_blank"> {{genUrl.href}}</a>
                                                    </b-col>
                                                    <b-col lg="8" >
                                                        <h5 class="mt-3">Want to use your own domain?</h5>
                                                        This is auto generated url for your landing page, to use your own domain add the your domain to the domain field below and go to your domain's <b>Manage DNS</b> settings and under <b>Forwarding</b> add this auto-genrated url to the destination.
                                                    </b-col>
                                                </b-row>
                                            </b-form-group>
                                        </b-col>
                                        <b-col lg="12">
                                            <b-form-group label="Domain" label-for="domain">
                                                <ValidationProvider name="domain" :rules="{ regex: /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/}" v-slot="{ errors }">
                                                    <b-form-input v-model="landingForm.domain" type="text"
                                                        placeholder="Domain"
                                                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                    <div class="invalid-feedback">
                                                        <span>{{ errors[0] }}</span>
                                                    </div>
                                                    <div><small>Don't have a domain? to create new <a href="https://www.godaddy.com" target="_blank">click here</a></small></div>
                                                </ValidationProvider>
                                            </b-form-group>
                                        </b-col>
                                        <b-col lg="12">
                                            <b-button type="submit" variant="primary" class="ml-3 float-right" :disabled="loader">
                                                Next <div v-if="loader"
                                                class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                            </b-button>
                                        </b-col>
                                  </b-row>
                                   
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
    import { core } from "../../config/pluginInit";
    import VerticleLayout from "../../layouts/VerticleLayout";
    import Navbar from "./Navbar.vue";
    import Parameter from "./Parameter.vue";

    export default {
        name: "Domain",
        layout: VerticleLayout,
        components: { Navbar,Parameter },

        mounted() {
            core.index();
            // this.addParamsToUrl();
        },

        props: {
            landing: Object,
            url: String
        },

        data() {
            return {
                loader: false,
                landingForm: this.landing,
                genUrl:new URL(location.protocol + "//" + this.url),
            };
        },

        methods: {
            async updateLandingPage() {
                const isValid = await this.$refs.landingObserver.validate()
                if (isValid) {
                    this.isLoading(true);
                    this.$inertia.put(this.route('client.landing.save.domain', this.landing.id), this.landingForm, {
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

            addParam () {
                this.landingForm.params.push({
                    key:'',
                    value:''                    
                });               
            },
            removeParam(paramCounter) {
                this.landingForm.params.splice(paramCounter,1);
            },

            isLoading(value) {
                this.loader = value;
            },
            // addParamsToUrl(){
            //      var params = this.landingForm.params;
            //     var newUrl = new URL(this.genUrl.origin)   
            //     Object.keys(params).forEach( index => {       
            //         newUrl.searchParams.append(params[index].key,params[index].value);                        
            //     });  
            //     this.genUrl = newUrl 
            // }
        },
        watch:{
            'landingForm.params':{
                handler: function(newVal, oldVal){
                //    this.addParamsToUrl();
                },
                deep: true,
            }
        }
       
    }
</script>
