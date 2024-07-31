<template>
    <div class="container mt-5">
      <h1 class="text-center">Stock Search</h1>
      <SearchbarComponent placeholder="Search by symbol" @onSearch="searchStock"/>
      <div v-if="error" class="alert alert-danger">{{ error }}</div>
      <table v-if="!loading && !error" class="table table-striped mt-5">
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
  import SearchbarComponent from './SearchbarComponent.vue';
  
  export default {
    components: {
      SearchbarComponent
    },
    data() {
      return {
        stock: {},
        loading: true,
        error: null,
      };
    },
    methods: {
      async searchStock(symbol) {
        try {
          if(!symbol) {
            throw new Error('Symbol is empty')
          }
          const response = await axiosInstance.get('/api/stock/?symbol='+symbol, {
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
  