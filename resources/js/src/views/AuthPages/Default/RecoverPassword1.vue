<template>
  <div>
    <h1 class="mb-0">Reset Password</h1>
    <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
    <div v-if="$page.props.flash.status" class="text-success">
  {{ $page.props.flash.status }}
</div>
    <form class="mt-4" @submit.prevent="reset">

      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input v-model="form.email" type="email" class="form-control mb-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

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
  props: ["email"],
  data: () => ({
    form: {
      email: "",
    }
  }),
  mounted() {
    this.form.email = this.$props.email;
  },
  methods: {
    reset() {
       this.$inertia.post(route('password.email'), this.form)
    },
    onSubmit() {
    
    },
  }
  
}
</script>
