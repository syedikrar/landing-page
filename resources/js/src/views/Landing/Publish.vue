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
                            <h4 class="card-title">Publish</h4>
                        </template>
                        <template v-slot:body>
                            <ValidationObserver ref="landingObserver">
                                <form novalidate @submit.prevent="updateLandingPage">
                                    <b-row align-v="center"> 
                                        <b-col lg="6">
                                            
                                                
                                                <h5>Ready to publish your landing page?</h5>
                                                
                                                <h5 class="landing-step"> <i class="fas fa-check text-success mr-1"></i>  <inertia-link id="myTab" data-toggle="tab" :href="route('client.landing.edit', landing.id)"> Landing Information</inertia-link></h5>
                                                <h5 class="landing-step"> <i  :class="landing.template_id ? 'fas fa-check text-success mr-1' : 'fas fa-times text-danger mr-2'"></i> 
                                                    <inertia-link id="myTab" data-toggle="tab"
                                                    :href="route('client.landing.select_template', landing.id)">Select Page Template</inertia-link></h5>
                                                <h5 class="landing-step"> <i :class="form ? 'fas fa-check text-success mr-1' : 'fas fa-times text-danger mr-2'"></i> 
                                                    <inertia-link id="myTab" data-toggle="tab"
                                                    :href="route('client.forms.show', landing.form_id)">Setup Form <span v-if="!form">(update form submission url)</span></inertia-link></h5>
                                                <h5 class="landing-step"> <i :class="page_template_updated ? 'fas fa-check text-success mr-1' : 'fas fa-times text-danger mr-2'"></i> 
                                                    <a :href="route('client.landing.edit_template', landing.id)" target="_blank" > Update page with visual editor</a>
                                                </h5>
                                                <h5 class="landing-step"> <i :class="thankyou_page_updated ? 'fas fa-check text-success mr-1' : 'fas fa-times text-danger mr-2'"></i> 
                                                    <a :href="route('client.landing.edit_thankyou_page', landing.id)" target="_blank" > Update Thank You page with visual editor</a>
                                                </h5>

                                                <b-form-group class="mt-3" label="URL for the landing page">
                                                    <b-row > 
                                                        <b-col lg="12">
                                                            <a :href="genUrl" target="_blank"> {{genUrl.href}}</a>
                                                        </b-col>
                                                    
                                                    </b-row>
                                                </b-form-group>
                                            
                                                <b-button  type="submit"  variant="primary" class=" mt-3" :disabled="loader">
                                                   Publish <div v-if="loader"
                                                            class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                                </b-button>
                                           
                                        </b-col>
                                        <b-col lg="6" class="text-right">
                                             <img :src="require('../../assets/images/Checklist.png')" class="img-fluid mb-0"
                                alt="logo" width="400px">
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
        name: "Publish",
        layout: VerticleLayout,
        components: { Navbar,Parameter },

        mounted() {
            core.index();
            // this.addParamsToUrl();
        },

        props: {
            landing: Object,
            url: String,
            form:Boolean,
            page_template_updated:Boolean,
            thankyou_page_updated:Boolean,
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
                    this.$inertia.put(this.route('client.landing.publish_landing', this.landing.id), this.landingForm, {
                        onSuccess: () => {
                            if (this.$page.props.flash.error) {
                                core.showSnackbar("error", this.$page.props.flash.error);
                            }else{
                                core.showSnackbar("success", "Landing page has been published successfully.&nbsp");
                            }
                            this.isLoading(false);
                        },
                        onError: () => {
                        core.showSnackbar("error", this.$page.props.flash.error);
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
