<template>
    <div class="news">
        <div class="news__header">DEFLI News</div>
        <div class="news__item" v-for="item in arrayDefliNews" :key="item.pubDate">
          {{ new Date(item.pubDate).toTimeString().slice(0, 5) }}  {{ item.title }}
        </div>
        <!-- <div class="news__header postimees">Postimees News</div>
        
        <div class="news__item" v-for="item in arrayPostimeesNews.slice(0, 10)" :key="item.pubDate">
          {{ new Date(item.pubDate).toTimeString().slice(0, 5) }}  {{ item.title }}
        </div> -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            rssUrlDelfi: 'https://osstep.ru/server.php?url=https://feeds2.feedburner.com/rusdelfinews',
            //rssUrlPosttimees: 'https://screen/server.php?url=https://rus.postimees.ee/rss',
            arrayDefliNews: []
            //arrayPostimeesNews: []
        }
    }, methods: {
        getNewsDelfi(rssUrl) {
            fetch(rssUrl)
        .then(response => response.json())
        .then(data => {
            this.arrayDefliNews = data;
            
        })
        .catch(error => console.error(error));
        }
        // getNewsPostimees(rssUrl) {
        //     fetch(rssUrl)
        // .then(response => response.json())
        // .then(data => {
        //     this.arrayPostimeesNews = data;
            
        // })
        // .catch(error => console.error(error));
        //         }

    }, mounted() {
        this.getNewsDelfi(this.rssUrlDelfi);
        //this.getNewsPostimees(this.rssUrlPosttimees);

        setInterval(() => {
            this.getNewsDelfi(this.rssUrlDelfi);
            //this.getNewsPostimees(this.rssUrlPosttimees);
        }, 600000)
    }
}
</script>
<style>
    .news__item {
        font-size: 18px;
        max-width: 1000px;
        margin-bottom: 5px;
    }
    .news__header {
        font-size: 24px;
        margin-bottom: 5px;
    }
    .postimees{
        margin-top: 20px;
    }
</style>