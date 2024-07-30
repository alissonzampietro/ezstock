<template>
    <div class="container mt-5">
      <h1 class="text-center">Stock Search</h1>
      <input
        type="text"
        class="form-control"
        placeholder="Search by symbol"
        v-model="symbol"
      />
      <button class="btn btn-primary" @click="searchStock">Search</button>
      <div v-if="error" class="alert alert-danger">{{ error }}</div>
      <table v-if="!loading && !error" class="table table-striped">
        <thead>
          <tr>
            <th>Symbol</th>
            <th>Open</th>
            <th>High</th>
            <th>Low</th>
            <th>Close</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ stock.symbol }}</td>
            <td>{{ stock.open }}</td>
            <td>{{ stock.high }}</td>
            <td>{{ stock.low }}</td>
            <td>{{ stock.close }}</td>
            <td>{{ stock.createdAt }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import axiosInstance from '../axios';
  
  export default {
    data() {
      return {
        symbol: '',
        stock: {},
        loading: true,
        error: null,
      };
    },
    created() {
      if(!localStorage.getItem('token')) {
        window.location.href = "/login"
      }
    },
    methods: {
      async searchStock() {
        try {
          if(!this.symbol) {
            throw new Error('Symbol is empty')
          }
          const response = await axiosInstance.get('/api/stock/?symbol='+this.symbol, {
            headers: {
              Authorization: localStorage.getItem('token')
            }
          });
          this.stock = response.data.data;
        } catch (error) {
          this.error = error.message ?? 'Failed to fetch stock';
          console.error(error);
        } finally {
          this.loading = false;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .container {
    margin-top: 50px;
  }
  </style>
  