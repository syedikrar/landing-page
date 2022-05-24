<template>
  <div>
    <h1 class="mb-0">Reset Password</h1>
    <form class="mt-4" @submit.prevent="reset">
<ValidationProvider vid="email" name="Email" rules="required" v-slot="{ errors }">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input v-model="form.email" type="email" :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
         <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
        <div class="invalid-feedback d-block" v-if=" $page.props.errors.checkUser">
                        {{ $page.props.errors.checkUser.email }}</div>
      </div>
        </ValidationProvider>
      
       <ValidationProvider vid="password" name="Password" rules="required" v-slot="{ errors }">
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input type="password" :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')"
                        id="passwordInput" v-model="form.password" placeholder="Password" required />
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                    <div class="invalid-feedback d-block" v-if=" $page.props.errors.checkUser">
                        {{ $page.props.errors.checkUser.password }}</div>
                </div>
            </ValidationProvider>
             <ValidationProvider vid="password_confirmation" name="Password" rules="required" v-slot="{ errors }">
                <div class="form-group">
                    <label for="passwordConfirmationInput">Confirm Password</label>
                    <input type="password" :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')"
                        id="passwordConfirmationInput" v-model="form.password_confirmation" placeholder="Password" required />
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                    
                </div>
            </ValidationProvider>
      

      <div class="d-inline-block w-100">
        <button type="submit" class="btn btn-primary float-right">Reset Password</button>
      </div>

    </form>
  </div>
</template>
<script>
import AuthLayout from "../../../layouts/AuthLayouts/AuthLayout";
export default {
  name: 'RecoverPassword1',
  layout:AuthLayout,
  data: () => ({
    form: {
      email: "",
      password:'',
      password_confirmation:'',
      token:route().params.token
    }
  }),
  mounted() {
    this.form.email = route().params.email;
    let token = route().params.token;
    let email = route().params.email;
  },
  methods: {
    reset() {
       this.$inertia.post(route('password.update'), this.form,{errorBag: 'checkUser',})
    },
    onSubmit() {
    
    },
  }
  
}
</script>
