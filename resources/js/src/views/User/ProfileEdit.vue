<template>
    <b-container fluid>
        <b-row>
            <b-col lg="12">
                <iq-card body-class="p-0">
                    <template v-slot:body>
                        <div class="iq-edit-list">
                            <tab-nav :pills="true" class="iq-edit-profile d-flex">
                                <tab-nav-items class="col-md-4 p-0" :active="true" href="#personal-information"
                                    title="Personal Information" />
                                <tab-nav-items class="col-md-4 p-0" :active="false" href="#company-information"
                                    title="Company Information" />
                                <tab-nav-items class="col-md-4 p-0" :active="false" href="#chang-pwd"
                                    title=" Security" />
                                <!-- <tab-nav-items class="col-md-3 p-0" :active="false" href="#emailandsms"
                                    title="Notifications" /> -->
                                <!--<tab-nav-items
                      class="col-md-3 p-0"
                      :active="false"
                      href="#manage-contact"
                      title="Activity"
                    />-->
                            </tab-nav>
                        </div>
                    </template>
                </iq-card>
            </b-col>
            <b-col lg="12">
                <div class="iq-edit-list-data">
                    <tab-content id="pills-tabContent-2">
                        <tab-content-item :active="true" id="personal-information">
                            <iq-card>
                                <template v-slot:headerTitle>
                                    <h4 class="card-title">Personal Information</h4>
                                </template>
                                <template v-slot:body>
                                    <ValidationObserver ref="InfoObserver" v-slot="{ errors }">
                                        <form novalidate @submit.prevent="submitInfo">
                                            <b-row align-v="center">
                                                <b-form-group class="col-md-6" label="First Name"
                                                    label-for="first_name">
                                                    <ValidationProvider name="First name" rules="required"
                                                        v-slot="{ errors }">
                                                        <b-form-input v-model="form.first_name" type="text"
                                                            placeholder="First Name"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                        <div class="invalid-feedback d-block"
                                                            v-if=" $page.props.errors.checkUser">
                                                            {{ $page.props.errors.checkUser.first_name }}</div>

                                                    </ValidationProvider>
                                                </b-form-group>
                                                <b-form-group class="col-md-6" label="Last Name" label-for="last_name">
                                                    <ValidationProvider name="Last name" rules="required"
                                                        v-slot="{ errors }">
                                                        <b-form-input v-model="form.last_name" type="text"
                                                            placeholder="Last Name"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                        <div class="invalid-feedback d-block"
                                                            v-if=" $page.props.errors.checkUser">
                                                            {{ $page.props.errors.checkUser.last_name }}</div>

                                                    </ValidationProvider>
                                                </b-form-group>
                                                <b-form-group class="col-md-6" label="Email" label-for="email">
                                                    <ValidationProvider name="Email" rules="required"
                                                        v-slot="{ errors }">
                                                        <b-form-input id="email" type="text" v-model="form.email"
                                                            disabled placeholder="Last Name"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                    </ValidationProvider>
                                                </b-form-group>

                                            </b-row>
                                            <b-button type="submit" variant="primary" class="mr-2" :disabled="loader">
                                                Update
                                                <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                            </b-button>
                                        </form>
                                    </ValidationObserver>

                                </template>

                            </iq-card>
                        </tab-content-item>
                        <tab-content-item :active="false" id="company-information">
                            <iq-card>
                                <template v-slot:headerTitle>
                                    <h4 class="card-title">Company Information</h4>
                                </template>
                                <template v-slot:body>
                                    <ValidationObserver ref="companyObserver" v-slot="{ errors }">
                                        <form novalidate @submit.prevent="updateCompanyInfo">
                                            <b-row align-v="center">
                                                <b-form-group class="col-md-6" label="Company Name" label-for="name">
                                                    <ValidationProvider name="Name" rules="required"
                                                        v-slot="{ errors }">
                                                        <b-form-input v-model="companyForm.name" type="text"
                                                            placeholder="Company Name"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                        <div class="invalid-feedback d-block"
                                                            v-if=" $page.props.errors.checkCompany">
                                                            {{ $page.props.errors.checkCompany.name }}</div>

                                                    </ValidationProvider>
                                                </b-form-group>
                                                <b-form-group class="col-md-6" label="Email" label-for="email">
                                                    <ValidationProvider name="Email" rules="required"
                                                        v-slot="{ errors }">
                                                        <b-form-input v-model="companyForm.email" type="text"
                                                            placeholder="Company Email"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                        <div class="invalid-feedback d-block"
                                                            v-if=" $page.props.errors.checkCompany">
                                                            {{ $page.props.errors.checkCompany.email }}</div>

                                                    </ValidationProvider>
                                                </b-form-group>

                                                <b-form-group class="col-md-6" label="Phone" label-for="phone">
                                                    <ValidationProvider name="phone" rules="" v-slot="{ errors }">
                                                        <b-form-input v-model="companyForm.phone" type="text"
                                                            placeholder="Company phone number"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                    </ValidationProvider>
                                                </b-form-group>
                                                <b-form-group class="col-md-6" label="Website Url"
                                                    label-for="website_url">
                                                    <ValidationProvider name="website_url" rules="" v-slot="{ errors }">
                                                        <b-form-input v-model="companyForm.website_url" type="text"
                                                            placeholder="Website Url"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                    </ValidationProvider>
                                                </b-form-group>
                                                <b-form-group class="col-sm-12" label="Address:" label-for="address">
                                                    <b-form-textarea name="address" v-model="companyForm.address"
                                                        style="line-height: 22px;" rows="5"></b-form-textarea>
                                                </b-form-group>

                                            </b-row>
                                            <b-button type="submit" variant="primary" class="mr-2" :disabled="loader">
                                                Update
                                                <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                            </b-button>
                                        </form>
                                    </ValidationObserver>

                                </template>

                            </iq-card>
                        </tab-content-item>
                        <tab-content-item :active="false" id="chang-pwd">
                            <iq-card>
                                <template v-slot:headerTitle>
                                    <h4 class="card-title">Change Password</h4>
                                </template>
                                <template v-slot:body>
                                    <ValidationObserver ref="passwordObserver" v-slot="{ errors }">
                                        <form @submit.prevent="changePassword">
                                            <b-row align-v="center">
                                                <b-form-group class="col-md-6" label="New Password:" label-for="pass">
                                                    <ValidationProvider vid="new_password" name="Password"
                                                        rules="required|min:8" v-slot="{ errors }">
                                                        <b-form-input v-model="passwordForm.new_password"
                                                            type="password" placeholder="Password"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>
                                                        <div class="invalid-feedback d-block"
                                                            v-if=" $page.props.errors.checkPassword">
                                                            {{ $page.props.errors.checkPassword.new_password }}</div>

                                                    </ValidationProvider>
                                                </b-form-group>
                                                <b-form-group class="col-md-6" label="Repeat Password:"
                                                    label-for="rpass">
                                                    <ValidationProvider vid="new_password_confirmation"
                                                        name="Repeat Password" rules="required|confirmed:new_password"
                                                        v-slot="{ errors }">
                                                        <b-form-input v-model="passwordForm.new_password_confirmation"
                                                            type="password" placeholder="Repeat Password"
                                                            :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                        </b-form-input>
                                                        <div class="invalid-feedback">
                                                            <span>{{ errors[0] }}</span>
                                                        </div>

                                                    </ValidationProvider>
                                                </b-form-group>
                                            </b-row>
                                            <b-button type="submit" variant="primary" class="mr-2" :disabled="loader">
                                                Update
                                                <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                            </b-button>
                                        </form>
                                    </ValidationObserver>
                                </template>
                            </iq-card>
                        </tab-content-item>
                        <tab-content-item :active="false" id="emailandsms">
                            <iq-card>
                                <template v-slot:headerTitle>
                                    <h4 class="card-title">Email and SMS</h4>
                                </template>
                                <template v-slot:body>
                                    <form @submit.prevent="">
                                        <div class="form-group row align-items-center">
                                            <label class="col-md-3" for="emailnotification">Email Notification:</label>
                                            <div class="col-md-9 custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="emailnotification" checked />
                                                <label class="custom-control-label" for="emailnotification"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-md-3" for="smsnotification">SMS Notification:</label>
                                            <div class="col-md-9 custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="smsnotification"
                                                    checked />
                                                <label class="custom-control-label" for="smsnotification"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-md-3" for="npass">When To Email</label>
                                            <div class="col-md-9">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="email01" />
                                                    <label class="custom-control-label" for="email01">You have new
                                                        notifications.</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="email02" />
                                                    <label class="custom-control-label" for="email02">You're sent a
                                                        direct message</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="email03"
                                                        checked />
                                                    <label class="custom-control-label" for="email03">Someone adds you
                                                        as a connection</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-md-3" for="npass">When To Escalate Emails</label>
                                            <div class="col-md-9">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="email04" />
                                                    <label class="custom-control-label" for="email04">Upon new
                                                        order.</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="email05" />
                                                    <label class="custom-control-label" for="email05">New membership
                                                        approval</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="email06"
                                                        checked />
                                                    <label class="custom-control-label" for="email06">Member
                                                        registration</label>
                                                </div>
                                            </div>
                                        </div>
                                        <b-button type="submit" variant="primary" class="mr-2">Update</b-button>
                                    </form>
                                </template>
                            </iq-card>
                        </tab-content-item>
                        <!-- <tab-content-item :active="false" id="manage-contact">
                  <iq-card>
                    <template v-slot:headerTitle>
                      <h4 class="card-title">Login Activity</h4>
                    </template>
                    <template v-slot:body>

                    
                    </template>
                  </iq-card>
                </tab-content-item> -->
                    </tab-content>
                </div>
            </b-col>
        </b-row>


    </b-container>
</template>
<script>
import {core} from "../../config/pluginInit";
import VerticleLayout from "../../layouts/VerticleLayout";

export default {
    name: "ProfileEdit",
    layout: VerticleLayout,
    mounted() {
        core.index();
    },
    props: {
        user: Object,
        company: Object
    },
    data() {
        return {
            loader: false,
            form: {
                first_name: this.user.first_name,
                last_name: this.user.last_name,
                email: this.user.email,
                profile_image: require("../../assets/images/user/user-11.png"),

            },
            companyForm: {
                name: this.company.name,
                email: this.company.email,
                phone: this.company.phone,
                address: this.company.address,
                website_url: this.company.website_url,
                is_owner: 0,
            },
            passwordForm: {
                new_password: "",
                new_password_confirmation: "",
            },
            currentPassword: "",
        };
    },
    methods: {
        async submitInfo() {
            this.isLoading(true)
            const isValid = await this.$refs.InfoObserver.validate()
            if (isValid) {
                this.$inertia.put(this.route('client.profile.update', this.user.id), this.form, {
                    onSuccess: () => {
                      core.showSnackbar("success", "Profile has been updated successfully.&nbsp")
                      this.isLoading(false)
                    },
                    onError: () => {
                      this.isLoading(false)
                    },
                    errorBag: 'checkUser',
                })
            }
        },

        previewImage: function (event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = e => {
                    this.user.profile_image = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        },

        async changePassword() {
            this.isLoading(true)
            const isValid = await this.$refs.passwordObserver.validate()
            if (isValid) {
                this.$inertia.put(this.route('client.profile.change_password'), this.passwordForm, {
                    onSuccess: () => {
                        core.showSnackbar("success", "Password has been updated successfully.&nbsp")
                        this.isLoading(false)
                    },
                    onError: () => {
                        this.isLoading(false)
                    },
                    errorBag: 'checkPassword',
                })
            }
        },

        async updateCompanyInfo() {
            this.isLoading(true)
            const isValid = await this.$refs.companyObserver.validate()
            if (isValid) {
                this.$inertia.put(this.route('client.profile.update_company_info'), this.companyForm, {
                    onSuccess: () => {
                        core.showSnackbar("success", "Company info has been updated successfully.&nbsp")
                        this.isLoading(false)
                    },
                    onError: () =>  {
                        this.isLoading(false)
                    },
                    errorBag: 'checkCompany',
                })
            }
        },

        isLoading(value) {
            this.loader = value;
        }
    }
};
</script>
