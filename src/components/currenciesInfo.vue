<template class="currencies__info">
    <div class="currencies__wrapper">
        <div class="currencies__item" v-for="(item, index) in arrayCurrencies" :key="index">
            <div class="currencies__item__name">
                {{ item.symbol }} {{ Math.ceil(item.values.USD.price) }} USD
            </div>
            <div class="currencies__item__change">
                <div class="currencies__item__change__item">
                    24h: {{ item.values.USD.percentChange24h.toFixed(2) < 0 ?  "&#9660;" : "&#9650;" }}{{ item.values.USD.percentChange24h.toFixed(2) }}%
                    7d: {{  item.values.USD.percentChange7d.toFixed(2) < 0 ?  "&#9660;" : "&#9650;" }}{{ item.values.USD.percentChange7d.toFixed(2) }}%
                    30d: {{  item.values.USD.percentChange30d.toFixed(2) < 0 ?  "&#9660;" : "&#9650;" }}{{ item.values.USD.percentChange30d.toFixed(2) }}%
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            arrayCurrencies: []
        }
    }, methods: {
        async getCurrencies() {
          const url = 'https://api.cryptorank.io/v1/currencies?api_key=8235d91e5dfe59a76f4747861eb3f198e135eea518221b6f4cd196b83f0f&symbols=BTC,LTC,BNB';
          const options = {
          method: 'GET',
        };
    
          await fetch(url, options)
            .then(response => response.json())
            .then(data => this.arrayCurrencies = data.data)
            .catch(error => console.error(error));
              }
    },
    mounted() {
        this.getCurrencies();
        setInterval(() => {this.getCurrencies()}, 1800000)

    }
}
</script>
<style>
    .currencies__wrapper {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }
    .currencies__item {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        margin-bottom: 20px;
    }
    .currencies__item__name {
        font-size: 40px;
    }
</style>