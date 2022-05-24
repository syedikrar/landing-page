<template>
    <b-container fluid>
        <b-row>
            <b-col lg="12">
                <iq-card body-class="p-0">
                    <ul id="myTab" class="iq-edit-profile d-flex nav nav-pills">
                        <li class="col-md-3 p-0 nav-item">
                            <inertia-link id="myTab" data-toggle="tab" :href="route('client.landing.edit',landing.id)"
                                role="tab" aria-controls="tabpanel" class="nav-link">
                                Step 1 - Basic Information
                            </inertia-link>
                        </li>
                        <li class="col-md-3 p-0 nav-item">
                            <inertia-link id="myTab" data-toggle="tab"
                                :href="route('client.landing.select_template',landing.id)" role="tab"
                                aria-controls="tabpanel" class="nav-link">
                                Step 2 - Choose Template
                            </inertia-link>
                        </li>
                        <li class="col-md-3 p-0 nav-item">
                            <inertia-link id="myTab" data-toggle="tab"
                                :href="route('client.landing.edit_template',landing.id)" role="tab"
                                aria-controls="tabpanel" class="nav-link   show active">
                                Step 3 - Edit Template
                            </inertia-link>
                        </li>
                        <li class="col-md-3 p-0 nav-item nav-disabled">
                            <inertia-link id="myTab" data-toggle="tab"
                                :href="route('client.landing.select_template',landing.id)" role="tab"
                                aria-controls="tabpanel" class="nav-link">
                                Step 4 - Edit Form
                            </inertia-link>
                        </li>
                    </ul>
                </iq-card>
            </b-col>
            <b-col lg="12">
                <div class="iq-edit-list-data">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Edit Landing Template</h4>
                        </template>
                        <template v-slot:body>
                            <ValidationObserver ref="landingObserver" v-slot="{ errors }">
                                <form novalidate @submit.prevent="updateLandingPage" enctype="multipart/form-data">
                                    <b-row align-v="center">

                                        <b-form-group class="col-md-12" label="Header Title" label-for="header_title">
                                            <ValidationProvider name="header title" rules="required"
                                                v-slot="{ errors }">
                                                <b-form-input v-model="templateForm.header_title" type="text"
                                                    placeholder="Header Title"
                                                    :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                            </ValidationProvider>
                                        </b-form-group>
                                        <b-form-group class="col-sm-12" label="Header Description"
                                            label-for="header_description">
                                            <b-form-textarea name="header description"
                                                v-model="templateForm.header_description" style="line-height: 22px;"
                                                rows="5"></b-form-textarea>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label="Button Text" label-for="button_text">
                                            <ValidationProvider name="Button text" rules="required" v-slot="{ errors }">
                                                <b-form-input v-model="templateForm.button_text" type="text"
                                                    placeholder="Button Text"
                                                    :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                            </ValidationProvider>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label="Button Link" label-for="button_link">
                                            <ValidationProvider name="Button link" rules="required" v-slot="{ errors }">
                                                <b-form-input v-model="templateForm.button_link" type="text"
                                                    placeholder="Button Link"
                                                    :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                            </ValidationProvider>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label="Header Image" label-for="header_image">
                                            <b-form-file v-model="templateForm.header_image" placeholder="Choose a file"
                                                id="header_image"></b-form-file>
                                        </b-form-group>
                                        <b-form-group class="col-md-6" label="Logo" label-for="logo">
                                            <b-form-file v-model="templateForm.logo" placeholder="Choose a file"
                                                id="logo"></b-form-file>
                                        </b-form-group>
                                    </b-row>
                                    <b-button type="submit" variant="primary" class="mr-2">Next</b-button>
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

export default {
    name: "ProfileEdit",
    layout: VerticleLayout,
    mounted() {
        core.index();
    },
    props: {
        landing: Object,
        landingData: Object
    },
    data() {
        return {
            templateForm: {
                landing_id: this.landing.id,
                header_title: this.landingData.header_title,
                header_description: this.landingData.header_description,
                button_text: this.landingData.button_text,
                button_link: this.landingData.button_link,
                logo: null,
                header_image: null
            },
            template_id: this.landing.template_id
        };
    },
    methods: {
        onSubmit() {},
        async updateLandingPage() {
            const isValid = await this.$refs.landingObserver.validate()
            if (isValid) {
                this.$inertia.post(this.route('client.landing.save_template_data'), this.templateForm, {
                    onSuccess: () => {
                        core.showSnackbar("success", "Landing page has been updated successfully.&nbsp")
                    },
                    errorBag: 'checkLanding',
                })
            }
        },
        previewImage: function (event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = e => {
                    this.templateForm.header_image = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
    }
}
</script>
