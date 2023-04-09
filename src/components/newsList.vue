<template>
    <div class="news">
        <div class="news__header">DEFLI News</div>
        <div class="news__item" v-for="item in arrayDefliNews.slice(0, 10)" :key="item.pubDate">
          {{ new Date(item.pubDate).toTimeString().slice(0, 5) }}  {{ item.title }}
        </div>
        <div class="news__header postimees">Postimees News</div>
        
        <div class="news__item" v-for="item in arrayPostimeesNews.slice(0, 10)" :key="item.pubDate">
          {{ new Date(item.pubDate).toTimeString().slice(0, 5) }}  {{ item.title }}
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            rssUrlDelfi: 'http://feeds2.feedburner.com/rusdelfinews',
            rssUrlPosttimees: 'https://rus.postimees.ee/rss',
            arrayDefliNews: [],
            arrayPostimeesNews: []
        }
    }, methods: {
        getNews(rssUrl, arr) {
            let xhr = new XMLHttpRequest();
            let result = []
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let rssData = xhr.responseText;
                let parser = new DOMParser();
                let xml = parser.parseFromString(rssData, 'application/xml');
                let items = xml.getElementsByTagName('item');
                for (let i = 0; i < items.length; i++) {
                let item = items[i];
                let title = item.getElementsByTagName('title')[0].textContent;
                let pubDate = item.getElementsByTagName('pubDate')[0].textContent;
                arr.push({ title, pubDate });
                }
                
            }
            };
            xhr.open('GET', rssUrl, true);
            xhr.send();
            return result;
        }

    }, mounted() {
        this.getNews(this.rssUrlDelfi, this.arrayDefliNews);
        this.getNews(this.rssUrlPosttimees, this.arrayPostimeesNews);

        setInterval(() => {
            this.getNews(this.rssUrlDelfi, this.arrayDefliNews);
        this.getNews(this.rssUrlPosttimees, this.arrayPostimeesNews);
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