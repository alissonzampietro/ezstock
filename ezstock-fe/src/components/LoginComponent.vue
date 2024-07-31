<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="card mt-6">
          <div class="card-body">
            <h2 class="card-title text-center">Login</h2>
            <form @submit.prevent="handleLogin">
              <div class="form-group">
                <label for="email">Email:</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  v-model="email"
                  required
                />
              </div>
              <div class="form-group mt-4">
                <label for="password">Password:</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  v-model="password"
                  required
                />
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-4">
                Login
              </button>
            </form>
          </div>
        </div>
        <div v-if="alertMessage" :class="`alert ${alertClass} alert-dismissible fade show`" role="alert">
          {{ alertMessage }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" v-on:click="closeButton()"></button>
        </div>
    </div>
  </div>
</template>

<script>
import axiosInstance from '../axios';
export default {
  data() {
    return {
      email: '',
      password: '',
      alertMessage: '',
      alertClass: ''
    };
  },
  methods: {
    closeButton() {
      this.alertMessage = ''
    },
    async handleLogin() {
      try {
        const loginResponse = await axiosInstance.post('/api/authenticate/login', {
          email: this.email,
          password: this.password,
        })
        localStorage.setItem('token', 'Bearer '+loginResponse.data.token);
        window.location.href="/search";
      }catch(error) {
        this.alertMessage = error.response.data.message;
        this.alertClass = 'alert-danger';
      }


    },
  },
};
</script>

<style scoped>
.container {
  margin-top: 50px;
}
.card {
  padding: 20px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
</style>
