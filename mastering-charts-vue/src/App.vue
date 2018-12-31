<template>
  <div id="app">
    <img src="./assets/logo.png">
    <router-view/>
    <v-chart v-bind:chartData="chartData"></v-chart>
  </div>
</template>

<script>
const grades =
    [
      { Name: 'Mary', Grade: 98 },
      { Name: 'Sam', Grade: 76 },
      { Name: 'Steve', Grade: 85 },
      { Name: 'Jill', Grade: 87 },
      { Name: 'Ben', Grade: 63 },
      { Name: 'Brian', Grade: 65 },
      { Name: 'Isabel', Grade: 90 }
    ]
export default {
  name: 'HelloWorld',
  data () {
    return {
      chartData: {
        chartType: 'barChart',
        selector: 'chart',
        title: 'Student Grades',
        subtitle: '2018 - 2019',
        width: 600,
        height: 300,
        metric: 'Grade',
        dim: 'Name',
        data: grades,
        overrides: {
          palette: {
            fill: '#34495E',
            stroke: '#41B883'
          },
          x: {
            ticks: 20
          },
          y: {
            axisWidth: 40
          }
        }
      }
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
