<template>
  <div class="login-view">
    <LoginComponent v-if="logIn"/>
    <RegisterComponent v-if="!logIn"/>
    <a v-on:click="logIn = !logIn">Click here to {{logIn ? 'register' : 'login'}}</a>
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
</style>
