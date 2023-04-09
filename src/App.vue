<template>
<div class="wrapper">
  <div id="wrapper__item">
    <news-list id="news-block"/>
  </div>
  <div class="wrapper__item">
    <weather-info id="weather-block"></weather-info>
    <currencies-info id="currencies-block"/>
    <todo-form id="todo-list"/>
  </div>
</div>
</template>

<script>

import weatherInfo from './components/weatherInfo.vue';
import currenciesInfo from './components/currenciesInfo.vue';
import newsList from './components/newsList.vue';
import todoForm from './components/todoForm.vue';
export default {
  components: {
    weatherInfo,
    currenciesInfo,
    newsList,
    todoForm

  },
  data() {
    return {
      
    }
  }
}
</script>

<style>
body {
  max-width: 1560px;
  height: 1200px;
  margin: 0 auto;
  box-sizing: border-box;
  background: #d1cfcf;
}
#app {
  margin-top: 20px;
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.wrapper {
  
  display: flex;
  justify-content: space-between;
  
  
}
#news-block {
  
}
#weather-block {
  
}
#currencies-block {
  
}
#todo-list {
  
}

</style>
