<template>
  <div class="login-view">
    <LoginComponent v-if="logIn"/>
    <RegisterComponent v-if="!logIn"/>
  </div>
  <div class="text-center mt-3">
    <a v-on:click="logIn = !logIn" class="login-link text-center">{{logIn ? 'Don\'t have an account? Register here' : 'Already have an account? Login here'}}</a>
  </div>
</template>
<script>
import LoginComponent from "../components/LoginComponent.vue";
import RegisterComponent from "../components/RegisterComponent.vue";
export default {
  name: 'App',
  data() {
    return {
      logIn: true
    }
  },
  components: {
    LoginComponent,
    RegisterComponent
  }
}
</script>
<style>
@media (min-width: 1024px) {
  .login-view {
    width: 100%;
  }
}

.login-link:hover {
  cursor: pointer !important;
  color: blue !important;
}
</style>
