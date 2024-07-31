<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="card mt-6">
          <div class="card-body">
            <h2 class="card-title text-center">Register page</h2>
            <form @submit.prevent="handleRegister">
              <div class="form-group">
                <label for="name">Name:</label>
                <input
                  type="name"
                  class="form-control"
                  id="name"
                  v-model="name"
                  required
                />
              </div>
              <div class="form-group mt-4">
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
              <div class="form-group mt-4">
                <label for="confirmPassword">Confirm Password:</label>
                <input
                  type="password"
                  class="form-control"
                  id="confirmPassword"
                  v-model="confirmPassword"
                  required
                />
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-4">
                Register
              </button>
            </form>
          </div>
          <div v-if="alertMessage" :class="`alert ${alertClass} alert-dismissible fade show`" role="alert">
            {{ alertMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" v-on:click="closeButton()"></button>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import axiosInstance from '../axios';
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
      alertMessage: '',
      alertClass: ''
    };
  },
  methods: {
    closeButton() {
      this.alertMessage = ''
    },
    cleanFields() {
      this.name= '';
      this.email= '';
      this.password= '';
      this.confirmPassword= '';
    },
    async handleRegister() {
      try {
        const response = await axiosInstance.post('/api/user/', {
          email: this.email,
          name: this.name,
          password: this.password,
          confirmPassword: this.confirmPassword,
        })
        this.cleanFields();
        this.alertMessage = response.data.message;
        this.alertClass = 'alert-success';
        setTimeout(() => {
          window.location.href = '/'
        }, 2000);
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
