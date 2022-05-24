<template>
    <b-container fluid>
        <vue-confirm-dialog class="confirm-dialog-custom"></vue-confirm-dialog>
        <b-row>
            <b-col lg="4">
                <iq-card body-class="text-center" :class="plans.bronze.package_purchased ? 'bg-primary text-white' : ''">
                    <template v-slot:body v-if="plans.bronze">
                        <span class="font-size-16 text-uppercase">bronze</span>
                        <h2 class="mb-4 display-3 font-weight-bolder" :class="plans.bronze.package_purchased ? 'text-white' : ''">
                            €{{ plans.bronze.instance.amount_decimal > 0 ? '' :  plans.bronze.instance.amount_decimal}}
                            <!-- <small class="font-size-14" v-if="plans.bronze.package_purchased" :class="plans.bronze.package_purchased ? 'text-white' : 'text-muted'">/ {{ plans.bronze.instance.interval  }}</small> -->
                            <br>
                        </h2>
                        <small class="font-size-16" v-if="plans.bronze.package_purchased"  :class="plans.bronze.package_purchased ? 'text-white' : 'text-muted'">
                            <b v-if="$page.props.auth.user.trail_expired">Free Trial Expired</b>
                             <b v-else> Trial expires on {{ plans.bronze.new_subscription_date }} </b>
                        </small>
                        <ul class="list-unstyled line-height-4 mb-0">
                            <b><li>{{ plans.bronze.allowed_landing }}</li></b>
                            <b><li>{{ plans.bronze.allowed_time }}</li></b>
                             <b><li>{{ plans.bronze.templates_available  }}</li></b>
                            <b><li>{{ plans.bronze.personlized_templates  }}</li></b>
                        </ul>
                        <b-button
                            :variant="plans.bronze.package_purchased ? 'light' : 'primary'"
                            class="mt-5" :disabled="plans.bronze.package_purchased" @click="handleClick(plans.bronze.instance.product)">
                            {{ plans.bronze.package_purchased ? 'Purchased' : 'Purchase' }}
                        </b-button>
                    </template>
                </iq-card>
            </b-col>
            <b-col lg="4">
                <iq-card body-class="text-center" :class="plans.silver.package_purchased ? 'bg-primary text-white' : ''">
                    <template v-slot:body v-if="plans.silver">
                        <span class="font-size-16 text-uppercase">silver</span>
                        <h2 class="mb-4 display-3 font-weight-bolder" :class="plans.silver.package_purchased ? 'text-white' : ''">
                            €{{ plans.silver.instance.amount_decimal > 0 ? plans.silver.instance.amount_decimal/100 :  plans.silver.instance.amount_decimal}}
                            <small class="font-size-14" :class="plans.silver.package_purchased ? 'text-white' : 'text-muted'">/ {{ plans.silver.instance.interval }}</small>
                        </h2>
                        <small class="font-size-16" v-if="plans.silver.package_purchased" :class="plans.silver.package_purchased ? 'text-white' : 'text-muted'"> <b>Upcoming subscription {{ plans.silver.new_subscription_date }} </b></small>
                        <ul class="list-unstyled line-height-4 mb-0">
                            <b><li>{{ plans.silver.allowed_landing }}</li></b>
                            <b><li>{{ plans.silver.allowed_time  }}</li></b>
                            <b><li>{{ plans.silver.templates_available  }}</li></b>
                            <b><li>{{ plans.silver.personlized_templates  }}</li></b>
                        </ul>
                        <b-button
                            :variant="plans.silver.package_purchased ? 'light' : 'primary'"
                            class="mt-5" :disabled="plans.silver.package_purchased" @click="handleClick(plans.silver.instance.product)">
                            {{ plans.silver.package_purchased ? 'Purchased' : 'Purchase' }}
                        </b-button>
                    </template>
                </iq-card>
            </b-col>
            <b-col lg="4">
                <iq-card body-class="text-center" :class="plans.gold.package_purchased ? 'bg-primary text-white' : ''">
                    <template v-slot:body v-if="plans.gold">
                        <span class="font-size-16 text-uppercase">gold</span>
                        <h2 class="mb-4 display-3 font-weight-bolder" :class="plans.gold.package_purchased ? 'text-white' : ''">
                            €{{ plans.gold.instance.amount_decimal > 0 ? plans.gold.instance.amount_decimal/100 :  plans.gold.instance.amount_decimal}}
                            <small class="font-size-14" :class="plans.gold.package_purchased ? 'text-white' : 'text-muted'">/ {{ plans.gold.instance.interval }}</small>
                        </h2>
                        <small class="font-size-16" v-if="plans.gold.package_purchased"  :class="plans.gold.package_purchased ? 'text-white' : 'text-muted'">
                            <b>Upcoming subscription {{ plans.gold.new_subscription_date }}</b>
                        </small>
                        <ul class="list-unstyled line-height-4 mb-0">
                            
                            <b><li>{{ plans.gold.allowed_landing }}</li></b>
                             <b><li>{{ plans.gold.allowed_time  }}</li></b>
                            <b><li>{{ plans.gold.templates_available  }}</li></b>
                            <b><li>{{ plans.gold.personlized_templates  }}</li></b>
                        </ul>
                        <b-button
                            :variant="plans.gold.package_purchased ? 'light' : 'primary'"
                            class="mt-5" :disabled="plans.gold.package_purchased" @click="handleClick(plans.gold.instance.product)"
                            >{{ plans.gold.package_purchased ? 'Purchased' : 'Purchase' }}
                        </b-button>
                    </template>
                </iq-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import { core } from "../../config/pluginInit";
    import VerticleLayout from "../../layouts/VerticleLayout";
    import { ValidationProvider, extend } from 'vee-validate';
    import { required } from 'vee-validate/dist/rules';
    import { loadStripe } from '@stripe/stripe-js';

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

        props: {
            plans: Object
        },

        data() {
            return {
                permissionsArray: this.$page.props.auth.user.permissions,
                loader: false,
                paymentData: {
                    plan_id: ''
                },
            }
        },

        methods: {
            // to process payments
            async processPayment() {
                // this.$inertia.post(this.route('client.subscriptions.store'), this.paymentData, {
                //     onSuccess: () => {
                //         core.showSnackbar("success", "Subscription activated successfully.");
                //         this.paymentProcessing = false;
                //         $('#payment').modal('hide');
                //         // this.isLoading(false);
                //     },
                //     onError: () => {
                //         this.paymentProcessing = false;
                //         // this.isLoading(false);
                //     },
                //     // errorBag: 'campaignErrors'
                // });
            },

            handleClick (planId) {
                this.paymentData.plan_id = planId;
                this.$confirm(
                    {
                        title: 'Are you sure you?',
                        message: 'Are you sure you want to subscribe this package?',
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
                                axios.get(this.route('client.check.card')).then(response => {
                                    if (response.data.status === 200) {
                                        this.$inertia.post(this.route('client.subscriptions.store'), this.paymentData, {
                                            onSuccess: () => {
                                                core.showSnackbar("success", "Subscription activated successfully.&nbsp");
                                                this.paymentProcessing = false;
                                                $('#payment').modal('hide');
                                                this.isLoading(false);
                                            },
                                            onError: () => {
                                                this.paymentProcessing = false;
                                                this.isLoading(false);
                                            },
                                        });
                                    } else {
                                        this.$inertia.visit(response.data.route);
                                    }
                                });
                            }
                        },
                    }
                )
            },

            isLoading(value) {
                this.loader = value;
            },
        },
        components: {
            ValidationProvider
        }
    }
</script>
