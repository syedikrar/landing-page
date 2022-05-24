<template>
    <div>
        <img src="https://coderthemes.com/hyper/saas/assets/images/mail_sent.svg" width="80" alt="">
        <h1 class="mt-3 mb-0">Success !</h1>
        <p class="ml-2">Before proceeding, please check your email for a verification link.</p>
        <p class="ml-2">If you did not receive the email</p>
        <div class="d-inline-block w-100">
            <b-button variant="primary" class="iq-waves-effect" type="submit" @click="resendVerificationEmail()" :disabled="loader">
                Click here to request another
                <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
            </b-button>
        </div>
    </div>
</template>
<script>
import AuthLayout from "../../layouts/AuthLayouts/AuthLayout";
import { core } from "../../config/pluginInit";

export default {
    name: 'Verify',
    layout: AuthLayout,

    mounted() {
        core.index();
    },

    data() {
        return {
            loader: false
        }
    },

    methods: {
        resendVerificationEmail () {
            this.isLoading(true);
            this.$inertia.visit(this.route('verification.resend'), {
                method:'post',
                onFinish: () => {
                    core.showSnackbar("success", "Verification email sent.&nbsp");
                    this.isLoading(false);
                },
                onError: () => {
                    core.showSnackbar("success", "Verification email sent.&nbsp");
                }
            });
        },

        isLoading(value) {
            this.loader = value;
        }
    }
}
</script>