<template>
    <div class="container mt-5">
      <h1 class="text-center">Stock Search</h1>
      <SearchbarComponent placeholder="Search by symbol" @onSearch="searchStock"/>
      <div v-if="error" class="alert alert-danger">{{ error }}</div>
      <table v-if="!firstLoad && !error && !searching" class="table table-striped mt-5">
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
      <p v-if="searching" class="text-center mt-3">Searching...</p>
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
        firstLoad: true,
        searching: false,
        error: null,
      };
    },
    methods: {
      async searchStock(symbol) {
        this.searching = true;
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
          this.searching = false;
        } catch (error) {
          this.error = error.message ?? 'Failed to fetch stock';
          console.error(error);
          this.searching = false;
        } finally {
          this.firstLoad = false;
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
  