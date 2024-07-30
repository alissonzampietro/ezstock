<template>
    <div class="container mt-5">
      <h1 class="text-center">Stock History</h1>
      <div v-if="loading" class="text-center">Loading...</div>
      <div v-if="error" class="alert alert-danger">{{ error }}</div>
      <div v-if="this.stocks.length === 0 && !loading" class="alert alert-warning text-center">There's no history at this moment. Search to build it.</div>
      <table v-if="!loading && !error && this.stocks.length > 0" class="table table-striped">
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
          <tr v-for="stock in stocks" :key="stock.symbol">
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
        stocks: [],
        loading: true,
        error: null,
      };
    },
    created() {
      if(!localStorage.getItem('token')) {
        window.location.href = "/login"
      }
      this.fetchStockHistory();
    },
    methods: {
      async fetchStockHistory() {
        try {
          const response = await axiosInstance.get('/api/stock/history', {
            headers: {
              Authorization: localStorage.getItem('token')
            }
          });
          this.stocks = response.data.data;
        } catch (error) {
          this.error = 'Failed to fetch stock history';
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
  