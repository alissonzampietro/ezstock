<template>
      <AuthenticatedArea>
        <StockSearch />
      </AuthenticatedArea>
  </template>
  
  <script>
  import StockSearch from '../components/StockSearchComponent.vue';
  import AuthenticatedArea from '../components/AuthenticatedAreaComponent.vue';
  
  export default {
    name: 'StockSearchView',
    components: {
      StockSearch,
      AuthenticatedArea
    },
  };
  </script>