<template>
    <b-container fluid>
        <b-row>
            <b-col lg="12">
                <b-row>
                    <b-col cols="12 text-right">
                        <b-button class=" mb-4" variant="primary" v-if="card.length && checkUserPermissions('add_cards')" data-toggle="modal" data-target="#card-info">Change Card</b-button>
                    </b-col>
                </b-row>
            </b-col>
            <b-col lg="12">
                <iq-card :style="card.length ? 'background:transparent' : ''">
                    <template v-slot:headerTitle v-if="card.length" class="text-center">
                        
                    </template>
                    <template class="mt-3" v-slot:body v-if="card.length">
                        <vue-c-card
                        :number="'**** **** **** ' + card[0].card.last4"
                        :holder="card[0].billing_details.name"
                        :exp="cardExpiry(card[0].card)"
                        :cvc="cc.cvc"
                        :is-typing-cvc="isTypingCvc"/>

                        <div class="d-none">
                            <label for="number">Number</label>
                            <input type="text" v-model="cc.number" id="number">

                            <label for="holder">Holder</label>
                            <input type="text" v-model="cc.holder" id="holder">

                            <label for="exp">Expiration Date</label>
                            <input type="text" v-model="cc.exp" id="exp">

                            <label for="cvc">CVC</label>
                            <input type="text" v-model="cc.cvc"
                            @focus="isTypingCvc = true"
                            @blur="isTypingCvc = false" id="cvc">
                        </div>
                    </template>
                    <template v-slot:body v-else>
                        <div class="text-center">
                            <img :src="require('../../assets/images/credit-card-animate.svg')" class="img-fluid mb-0" alt="logo" width="360px">
                            
                            <h2 class="mb-3 mt-0">Hi, Let's setup your billing information!</h2>
                            <b-button class="mb-3" variant="primary" data-toggle="modal" data-target="#card-info">Get Started</b-button>
                        </div>
                    </template>
                </iq-card>
            </b-col>
        </b-row>
        
        <!-- modal section -->
        <div class="modal fade" id="card-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Process Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ValidationObserver ref="cardObserver">
                            <b-form-group label="Name">
                                <ValidationProvider name="Name" rules="required" v-slot="{ errors }">
                                    <b-input type="text" v-model="paymentData.name" :class="(errors.length > 0 ? ' is-invalid' : '')">
                                    </b-input>
                                    <div class="invalid-feedback">
                                        <span>{{ errors[0] }}</span>
                                    </div>
                                </ValidationProvider>
                            </b-form-group>
                            <b-form-group label="Email">
                                <ValidationProvider name="Email" rules="required" v-slot="{ errors }">
                                    <b-input type="email" v-model="paymentData.email" :class="(errors.length > 0 ? ' is-invalid' : '')">
                                    </b-input>
                                    <div class="invalid-feedback">
                                        <span>{{ errors[0] }}</span>
                                    </div>
                                </ValidationProvider>
                            </b-form-group>
                            <b-form-group label="Card Information">
                                <div id="card-element"></div>
                            </b-form-group>
                            <input type="hidden" :value="paymentData.plan_id">
                            <div class="d-flex justify-content-end">
                                <b-button variant=" iq-bg-primary" class="iq-waves-effect" data-dismiss="modal">Cancel</b-button>
                                <b-button variant="primary ml-2" class="iq-waves-effect" type="submit" @click="saveCardInfo" :disabled="loader">
                                    Save
                                    <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                </b-button>
                            </div>
                        </ValidationObserver>
                    </div>
                </div>
            </div>
        </div>
    </b-container>
</template>

<script>
    import { core } from "../../config/pluginInit";
    import VerticleLayout from "../../layouts/VerticleLayout";
    import { loadStripe } from '@stripe/stripe-js';
    import VueCCard from 'vue-ccard';

    export default {
        name: "Index",
        layout: VerticleLayout,

        async mounted() {
            core.index();
            this.stripe = await loadStripe('pk_live_51Jqz6FBQGa8GfwPLTAdTFl5Zi99LYIW2KCepIuPSFZmcgVeeTvqX0hO1vFA4yIH9HEu2VFTokzMTmMaMsVIDi1yW002BsdTWSP');

            const elements = this.stripe.elements();
            const self = this
            $('#card-info').on('shown.bs.modal', function () {
                self.cardElement = elements.create('card', {
                    classes: {
                        base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'
                    }
                })
                
                self.cardElement.mount('#card-element');
            })
        },

        props: {
            card: Array,
        },

        data() {
            return {
                loader: false,
                permissionsArray: this.$page.props.auth.user.permissions,
                stripe: {},
                cardElement: {},
                paymentData: {
                    name: this.$page.props.auth.user.first_name,
                    email: this.$page.props.auth.user.email,
                    payment_method_id: '',
                    plan_id: ''
                },
                isTypingCvc: false,
                cc: {
                    number: '',
                    holder: '',
                    exp: '',
                    cvc: '',
                },
            }
        },

        methods: {
            // save card details
            async saveCardInfo() {
              
                const {paymentMethod, error} = await this.stripe.createPaymentMethod (
                    'card', this.cardElement, {
                        billing_details: {
                            name: this.paymentData.name,
                            email: this.paymentData.email
                        }
                    }
                );

                if (error) {
                    // this.loader = false;
                    // console.error(error);
                } else {
                    this.paymentData.payment_method_id = paymentMethod.id;
                    this.loader = true;
                    this.$inertia.post(this.route('client.cards.store'), this.paymentData, {
                        onSuccess: () => {
                            core.showSnackbar("success", "Card saved successfully.&nbsp");
                            $('#card-info').modal('hide');
                            this.loader = false;
                        },
                        onError: () => {
                            this.loader = false;

                        },
                    });
                }
            },
            
            cardExpiry (card) {
                return card.exp_month + '/' + card.exp_year;
            },

            checkUserPermissions(value) {
                return this.permissionsArray.includes(value);
            },
        },

        components: {
            VueCCard,
        },
    }
</script>
