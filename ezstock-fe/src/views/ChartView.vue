<template>
    <AuthenticatedArea>
      <div v-if="stocks.length > 0">
        <h3 class="mt-4 mb-2 text-center">Select your stock to see the graph</h3>
        <button v-for="label in stockLabels" class="btn btn-outline-dark btn-space" :class="{'selected': label === selectedStock}" v-on:click="loadGraph(label)">{{ label }}</button>
        <Line
            v-if="preChart.isDefined"
            id="my-chart-id"
            :options="chartOptions"
            :data="chartData"
        />
      </div>
      <h3 class="mt-4 mb-2 text-center" v-else>You haven't searched any stock yet...</h3>
      </AuthenticatedArea>
</template>

<script>
import { Line } from 'vue-chartjs';
import { 
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
 } from 'chart.js'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement, 
  LineElement,
  Title,
  Tooltip,
  Legend
)

import AuthenticatedArea from '../components/AuthenticatedAreaComponent.vue'
import axiosInstance from '../axios';

export default {
  name: 'ChartView',
  components: { 
    Line,
    AuthenticatedArea,
  },
  created() {
    this.fetchStockHistory()
  },
  computed: {
    chartData() {
      return {
        labels: this.preChart.labels,
        datasets: this.preChart.datasets
      };
    }
  },
  methods: {
    loadGraph(stock) {
      this.preChart.isDefined = false;
      this.preChart.labels = [];
      this.preChart.datasets = [];
      
      const dataSetOpen = {
        label: 'OPEN',
        backgroundColor: '#fce500',
        data: []
      };
      const dataSetClose = {
        label: 'CLOSE',
        backgroundColor: '#27509b',
        data: []
      };
      const dataSetHigh = {
        label: 'HIGH',
        backgroundColor: '#84bd00',
        data: []
      };
      const dataSetLow = {
        label: 'LOW',
        backgroundColor: '#582c83',
        data: []
      };
      this.stockStructure[stock].forEach(s => {
        this.preChart.labels.push(s.createdAt)
        dataSetOpen.data.push(s.open)
        dataSetClose.data.push(s.close)
        dataSetHigh.data.push(s.high)
        dataSetLow.data.push(s.low)
      })
      this.preChart.datasets = [dataSetOpen, dataSetClose, dataSetHigh, dataSetLow];
      this.selectedStock = stock;
      this.preChart.isDefined = true;
    },
    structureData() {
      this.stocks.toReversed().forEach(stock => {
        if(!this.stockStructure[stock['symbol']]) {
          this.stockStructure[stock['symbol']] = [];
          this.stockLabels.push(stock['symbol']);
        }else {
          this.stockStructure[stock['symbol']].push(stock);
        } 
      })
      console.log(this.stockStructure);
    },
    async fetchStockHistory() {
        try {
          const response = await axiosInstance.get('/api/stock/history', {
            headers: {
              Authorization: localStorage.getItem('token')
            }
          });
          this.stocks = response.data.data;
          if(this.stocks.length > 0) {
            this.structureData();
          }
        } catch (error) {
          this.error = 'Failed to fetch stock history';
          window.alert('Failed to fetch stock history');
          console.error(error);
        }
    },
  },
  data() {
    return {
      selectedStock: '',
      stockStructure: {},
      stockLabels: [],
      error: '',
      stocks: [],
      preChart: {
        isDefined: false,
        labels: [],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: []
          },
        ]
      },
      chartOptions: {
        responsive: true,
      }
    }
  }
}
</script>

<style scoped>
.btn-space {
  margin-right: 10px;
}

.selected {
  background-color: #212529 !important;
  color: #fff !important;
}
</style>