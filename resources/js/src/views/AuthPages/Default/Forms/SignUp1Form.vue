<template>
    <ValidationObserver ref="observer" v-slot="{ errors }">
        <form class="mt-4" novalidate @submit.prevent="register">
            <ValidationProvider :vid="`${formType}-firstname`" name="First Name" rules="required" v-slot="{ errors }">
                <div class="form-group">
                    <label :for="`${formType}-firstname`">First Name</label>
                    <input type="text" v-model="form.first_name"
                        :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')"
                        :id="`${formType}-firstname`" aria-describedby="emailHelp" placeholder="First Name" required>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                    <div class="invalid-feedback d-block" v-if=" $page.props.errors.checkUser">
                        {{ $page.props.errors.checkUser.first_name }}</div>

                </div>
            </ValidationProvider>
            <ValidationProvider :vid="`${formType}-name`" name="Last Name" rules="required" v-slot="{ errors }">
                <div class="form-group">
                    <label :for="`${formType}-name`">Last Name</label>
                    <input type="text" v-model="form.last_name"
                        :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')" :id="`${formType}-name`"
                        aria-describedby="emailHelp" placeholder="Last Name" required>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                    <div class="invalid-feedback d-block" v-if=" $page.props.errors.checkUser">
                        {{ $page.props.errors.checkUser.last_name }}</div>

                </div>
            </ValidationProvider>
            <ValidationProvider :vid="`${formType}-email`" name="Email" rules="required|email" v-slot="{ errors }">
                <div class="form-group">
                    <label :for="`${formType}-email`">Email address</label>
                    <input type="email" v-model="form.email"
                        :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '') "
                        :id="`${formType}-email`" aria-describedby="emailHelp" placeholder="Enter email">
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>

                    <div class="invalid-feedback d-block" v-if=" $page.props.errors.checkUser">
                        {{ $page.props.errors.checkUser.email }}</div>


                </div>
            </ValidationProvider>
            <ValidationProvider :vid="`${formType}-password`" name="Password" rules="required" v-slot="{ errors }">
                <div class="form-group">
                    <label :for="`${formType}-password`">Password</label>
                    <input type="password" v-model="form.password"
                        :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')"
                        :id="`${formType}-password`" placeholder="Password">
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                    <div class="invalid-feedback d-block" v-if=" $page.props.errors.checkUser">
                        {{ $page.props.errors.checkUser.password }}</div>

                </div>
            </ValidationProvider>

            <div class="d-inline-block w-100">
            <ValidationProvider :vid="`${formType}-terms`" name="Terms" rules="required" v-slot="{ errors }">
            
                <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                    <input type="checkbox"  :class="'custom-control-input' +(errors.length > 0 ? ' is-invalid' : '')" 
                    :id="`${formType}-terms`" v-model="form.terms">
                    <label class="custom-control-label" :for="`${formType}-terms`">I accept <a href="#">Terms and
                           
                            Conditions</a></label>
                             <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </div>
                  </ValidationProvider>
                <button type="submit" class="btn btn-primary float-right" :disabled="loader">
                    Sign Up <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status">
                    </div>
                </button>
            </div>
            <div class="sign-info">
                <span class="dark-color d-inline-block line-height-2">
                    Already Have Account ?
                    <inertia-link href="/login" class="iq-waves-effect pr-4">
                        Sign in
                    </inertia-link>
                </span>
            </div>
        </form>
    </ValidationObserver>
</template>

<script>
import {mapGetters} from 'vuex'
import { ValidationProvider, extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';

extend('required', {
  message: field => field + ' is required.',
});

export default {
    name: 'SignUp1Form',
    components: {},
    props: ['formType'],
    computed: {
     
    },
    data() {
        return {
            loader: false,
            form: {
                first_name: null,
                last_name: null,
                password: null,
                email: null,
                terms: null,
            },
            errors: {
                checkUser: {
                    first_name: ''
                }
            }
        }

    },
    methods: {
        onSubmit() {
            register()
        },
        async register() {
            const isValid = await this.$refs.observer.validate()
            if (isValid) {
                this.loader = true;
                this.$inertia.post(route('register'), this.form, {
                    onError: () => {
                        this.loader = false;
                    },
                    onSuccess: () => {
                        this.loader = false;
                    },
                    errorBag: 'checkUser',
                })
            }
        },
    }
}
</script>
