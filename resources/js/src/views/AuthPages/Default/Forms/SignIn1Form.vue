<template>
    <ValidationObserver ref="observer" v-slot="{ errors }">
        <form class="mt-4" novalidate @submit.prevent="login">
            <ValidationProvider vid="email" name="E-mail" rules="required|email" v-slot="{ errors }">
                <div class="form-group">
                    <label for="emailInput">Email address</label>
                    <input type="email"
                        :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '') +($page.props.errors.checkUser ? ' is-invalid' : '')"
                        id="emailInput" aria-describedby="emailHelp" v-model="user.email" placeholder="Enter email"
                        required />
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                    <div class="invalid-feedback" v-if=" $page.props.errors.checkUser">
                        {{ $page.props.errors.checkUser.email }}</div>

                </div>
            </ValidationProvider>
            <ValidationProvider vid="password" name="Password" rules="required" v-slot="{ errors }">
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <inertia-link :href="route('password.request')" class="float-right">Forgot password?</inertia-link>
                    <input type="password" :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')"
                        id="passwordInput" v-model="user.password" placeholder="Password" required />
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </div>
            </ValidationProvider>
            <div class="d-inline-block w-100">
                <button type="submit" class="btn btn-primary float-right" :disabled="loader">
                    Sign in <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status">
                    </div>
                </button>
            </div>
            <div class="sign-info">
                <span class="dark-color d-inline-block line-height-2">
                    Don't have an account?

                    <inertia-link href="/register" class="iq-waves-effect pr-4">Sign up</inertia-link>
                </span>

            </div>
        </form>
    </ValidationObserver>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "SignIn1Form",
  components: {  },
  props:{
    errors: Object,
  },
  data: () => ({
    loader: false,
    user: {
      email: "",
      password: ""
    }
  }),
  mounted() {
    this.user.email = this.$props.email;
    this.user.password = this.$props.password;
  },
  computed: {

  },
  methods: {
    async login() {
      const isValid = await this.$refs.observer.validate()
      if (isValid) {
          this.loader = true;
          this.$inertia.post(route('login'), this.user, {
            onError: () => {
              this.loader = false;
            },
            errorBag: 'checkUser',
        })
      }
    },
  }
}
</script>
