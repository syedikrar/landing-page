<template>
  <div>
    <h1 class="mb-0">Sign Up</h1>
    <p>Enter your email address and password to access admin panel.</p>
    <sign-up1-form formType="auth"></sign-up1-form>
  
  </div>
</template>
<script>

import SignUp1Form from './Forms/SignUp1Form'
import auth0 from 'auth0-js'
import AuthLayout from "../../../layouts/AuthLayouts/AuthLayout";


export default {
  name: 'SignUp1',
  layout:AuthLayout,
  components: { SignUp1Form },
  data: () => ({}),
  methods: {
    
  }
}
</script>
