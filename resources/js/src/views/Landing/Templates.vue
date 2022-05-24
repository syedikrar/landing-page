<template>
    <b-container fluid>
        <b-row>
            <b-col lg="12">
                <navbar :landing="landing"></navbar>
            </b-col>
            <b-col sm="12">
                <h3 class="mt-4 mb-3">Choose template for the landing page</h3>
            </b-col>
        </b-row>

        <div v-if="selectTemplate">
            <ValidationObserver ref="templateObserver" v-slot="{ errors }" >
                <form novalidate @submit.prevent="saveTemplate">
                    <b-row>
                        <b-col sm="4" class="mt-3 template" v-for="template in templates" :key="template.id">
                            <b-card no-body :img-src="'/templates/thumbnails/'+template.thumbnail" img-alt="#" img-top>
                                <b-card-body>
                                    <b-card-title>
                                        <ValidationProvider name="template" rules="required" v-slot="{ errors }">
                                            <b-form-radio inline v-model="landingForm.template_id" name="template"
                                                :value="template.id" :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                {{template.name}}</b-form-radio>
                                            <div class="invalid-feedback">
                                                <span>Please select a template</span>
                                            </div>
                                        </ValidationProvider>
                                    </b-card-title>
                                    <b-button :to="'/' +template.preview_url" target="_blank" variant="primary" size="sm"
                                        class="preview-btn" type="button"><i class="fas fa-eye"></i> Preview </b-button>
                                </b-card-body>
                            </b-card>
                        </b-col>
                        <b-col sm="12">
                            <b-button type="submit" variant="primary" class="mr-2 mt-4 mb-4 float-right">Next</b-button>
                        </b-col>
                    </b-row>
                </form>
            </ValidationObserver>
        </div>
        <div v-else>

            <h4>By changing the template you will the loose the changes made to the current template</h4>
            <b-row>
                        <b-col sm="4" class="mt-3 template" v-for="template in templates.filter((template) => template.id == landingForm.template_id)" :key="template.id">
                            <b-card no-body :img-src="'/templates/thumbnails/'+template.thumbnail" img-alt="#" img-top >
                                <b-card-body>
                                    <b-card-title>
                                        <ValidationProvider name="template" rules="required" v-slot="{ errors }">
                                            <b-form-radio inline v-model="landingForm.template_id" name="template"
                                                :value="template.id" :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                {{template.name}}</b-form-radio>
                                            <div class="invalid-feedback">
                                                <span>Please select a template</span>
                                            </div>
                                        </ValidationProvider>
                                    </b-card-title>
                                    <b-button :to="'/' +template.preview_url" target="_blank" variant="primary" size="sm"
                                        class="preview-btn" type="button"><i class="fas fa-eye"></i> Preview </b-button>
                                </b-card-body>
                            </b-card>
                        </b-col>
                        
                    </b-row>
             <b-button class=" mb-4 mt-3" variant="primary" @click="allowChangingTemplate()" >I understand</b-button>
        </div>
    </b-container>
</template>
<script>
import {core} from "../../config/pluginInit";
import VerticleLayout from "../../layouts/VerticleLayout";
import Navbar from "./Navbar.vue";

export default {
    name: "Templates",
    layout: VerticleLayout,
    components: {
        Navbar
    },
    props: {
        landing: Object,
        templates: Array
    },
    data() {
        return {
            landingForm: {
                landing_id: this.landing.id,
                template_id: this.landing.template_id
            },
            selectTemplate:this.landing.template_id ? false: true,
        }
    },
    mounted() {
        core.index();
    },
    methods: {
        onSubmit() {},
        async saveTemplate() {
            const isValid = await this.$refs.templateObserver.validate()
            if (isValid) {
                this.$inertia.post(this.route('client.landing.save_template'), this.landingForm, {
                    onSuccess: () => {
                        core.showSnackbar("success", "Landing page has been updated successfully.&nbsp")
                    },
                    errorBag: 'checkLanding',
                })
            }
        },
        allowChangingTemplate(){
            this.selectTemplate = true;
        },
    }
}
</script>