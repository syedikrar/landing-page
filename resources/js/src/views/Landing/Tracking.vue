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
                            <h4 class="card-title">Tracking</h4>
                        </template>
                        <template v-slot:body>
                            <ValidationObserver ref="landingObserver">
                                <form novalidate @submit.prevent="updateLandingPage" class="row">
                                   
                                    <b-form-group class="col-sm-12" label="Google analytics code:" label-for="google_analytics">
                                        <b-form-textarea name="google_analytics"  v-model="landingForm.google_analytics"
                                            style="line-height: 22px;" rows="8"></b-form-textarea>
                                    </b-form-group>
                                     <b-form-group class="col-md-12" label-for="pixel_type" label="Pixel Type">
                                        <b-form-select plain v-model="landingForm.pixel_type" id="pixel_type">
                                            <template v-slot:first>
                                                <b-form-select-option  value="code">
                                                    Javascript Code
                                                </b-form-select-option>
                                                <b-form-select-option value="img">
                                                    Img tag src
                                                </b-form-select-option>
                                                <b-form-select-option value="url">
                                                    S2S url
                                                </b-form-select-option>
                                            </template>
                                        </b-form-select>
                                    </b-form-group>
                                    <b-form-group class="col-sm-12" label="Pixel code:" label-for="pixel_code" v-if="landingForm.pixel_type=='code'">
                                        <b-form-textarea name="pixel_code" v-model="landingForm.pixel"
                                            style="line-height: 22px;" rows="8"></b-form-textarea>
                                    </b-form-group>
                                    <b-form-group class="col-sm-12" label="Pixel img src:" label-for="pixel_code" v-if="landingForm.pixel_type=='img'">
                                        <b-form-input type="text" name="pixel_code" v-model="landingForm.pixel"
                                            style="line-height: 22px;" rows="8"></b-form-input>
                                    </b-form-group>
                                    <b-form-group class="col-sm-12" label="Pixel url:" label-for="pixel_code" v-if="landingForm.pixel_type=='url'">
                                    <ValidationProvider name="pixel url" ref="urlInput"  :rules="{ regex: /\b(https?|ftp|file):\/\/[\-A-Za-z0-9+&@#\/%?=~_|!:,.;]*[\-A-Za-z0-9+&@#\/%=~_|]/}" v-slot="{ errors }">

                                        <b-form-input type="text" name="pixel_code" v-model="landingForm.pixel"
                                            style="line-height: 22px;" rows="8"
                                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                            <div class="invalid-feedback">
                                                <span>{{ errors[0] }}</span>
                                            </div>
                                    </ValidationProvider>

                                    </b-form-group>
                        
                                    <b-form-group class="col-md-12  mt-3" label="Pixel with custom parameters" v-if="landingForm.pixel_type=='url'">
                                        <b-row>
                                            <b-col lg="10">{{pixelUrl}}</b-col>
                                           
                                        </b-row>
                                    </b-form-group>
                                     <b-col lg="12 mt-3" v-if="landingForm.pixel_type=='url'">
                                    <h5 class="mb-3">Custom Parameters</h5>
                                    <p>Add custom parameters to receive them back in the tracking pixel/postback</p>
                                     <Parameter  v-for="(param, index) in landingForm.params"
                                        @removeParam="removeParam"
                                        :key="index"
                                        :paramCounter="index"
                                        :param="param">
                                    </Parameter>
                                        
                                    <b-button class=" mb-4" variant="primary"  @click="addParam()" >Add Parameter</b-button>
                                    
                                     </b-col>

                                    <b-col lg="12 mt-3 mx-0" v-if="landingForm.pixel_type=='url'">
                                    <h5 class="mb-3">Static Parameters</h5>
                                    <p>Add custom static parameters to receive them back in the tracking pixel/postback</p>
                                     <StaticParameter  v-for="(staticParam, index) in landingForm.static_params"
                                        @removeStaticParam="removeStaticParam"
                                        :key="index"
                                        :paramCounter="index"
                                        :static_param="staticParam">
                                    </StaticParameter>

                                    <b-button class=" mb-4" variant="primary"  @click="addStaticParam()" >Add Static Parameter</b-button>
                                    <p class="text-primary" >The system will automaticallly attach "lead_id" to the pixel/postback</p>
                                    
                                    </b-col>
                                      
                                    <b-col sm="12">
                                    <b-button type="submit" variant="primary" class="ml-3 float-right" :disabled="loader">
                                        Next <div v-if="loader"
                                            class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                    </b-button>
                                   </b-col>
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
    import StaticParameter from "./StaticParameter.vue";


    export default {
        name: "Domain",
        layout: VerticleLayout,
        components: { Navbar,Parameter ,StaticParameter},

        mounted() {
            core.index();
            this.addParamsToUrl();
        },

        props: {
            landing: Object,
            url: String
        },

        data() {
            return {
                loader: false,
                landingForm: this.landing,
                pixelUrl: (this.landing.pixel_type=="url") ? this.landing.pixel : null
                
            };
        },

        methods: {
            async updateLandingPage() {
                const isValid = await this.$refs.landingObserver.validate()
                if (isValid) {
                    this.isLoading(true);
                    this.$inertia.put(this.route('client.landing.save.tracking', this.landing.id), this.landingForm, {
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
            },
            addParam () {
                this.landingForm.params.push({
                    key:'',
                    value:'',
                    type:'dynamic'                   
                });               
            },
             addStaticParam () {
                this.landingForm.static_params.push({
                    key:'',
                    value:'',
                    type:'static'                   
                });            
            },
            removeParam(paramCounter) {
                this.landingForm.params.splice(paramCounter,1);
            },
            removeStaticParam(paramCounter) {
                this.landingForm.static_params.splice(paramCounter,1);
            },
            addParamsToUrl(){

                if(this.landingForm.pixel_type == 'url'){
                    var params = this.landingForm.params;
                    var newUrl = new URL(this.landingForm.pixel)   
                    Object.keys(params).forEach( index => {       
                        newUrl.searchParams.append(params[index].key,'{{'+params[index].key+'}}');                        
                    }); 

                    var static_params = this.landingForm.static_params;
                    Object.keys(static_params).forEach( index => {       
                        newUrl.searchParams.append(static_params[index].key, static_params[index].value);                        
                    });  

                    this.pixelUrl = decodeURI(newUrl)
                }
            },        
        },
         watch:{
            'landingForm.pixel':{
               handler: async  function(newVal, oldVal){
                const isValid = await this.$refs.landingObserver.validate()
                   
                if(this.landingForm.pixel_type == 'url' && isValid && this.landingForm.pixel){
                   this.addParamsToUrl();
                }},
               
            }, 
            'landingForm.params':{
                handler: async function(newVal, oldVal){
                const isValid = await this.$refs.landingObserver.validate()

                   if(this.landingForm.pixel_type == 'url' && isValid && this.landingForm.pixel){
                   this.addParamsToUrl();
                }
                },
                deep: true,
            },
            'landingForm.static_params':{
                handler: async function(newVal, oldVal){
                const isValid = await this.$refs.landingObserver.validate()

                   if(this.landingForm.pixel_type == 'url' && isValid && this.landingForm.pixel){
                      this.addParamsToUrl();

                //    this.addStaticParamsToUrl();
                }
                },
                deep: true,
            }
        }
      
    }
</script>
