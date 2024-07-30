<template>
    <div id="app">
      <AuthenticatedArea>
        <StockHistory />
      </AuthenticatedArea>
    </div>
  </template>
  
  <script>
  import StockHistory from '../components/StockHistoryComponent.vue';
  import AuthenticatedArea from '../components/AuthenticatedAreaComponent.vue';
  
  export default {
    name: 'StockHistoryView',
    components: {
      StockHistory,
      AuthenticatedArea
    },
  };
  </script>