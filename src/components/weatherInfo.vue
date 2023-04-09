<template>
    <div class="info">

      <div class="time">
        <div>{{ actualDay + " " + actualDayNumber + " " + actualTime.slice(0, 5) }}</div>

      </div>
      <div class="weather">
        <div class="weather__item">
          <div v-html="weatherImgURl"></div>
          <div class="weather__item__value">
            {{ Math.ceil(actualTemp) + "°C"}}
          </div>
        </div>
        <div class="weather__item">
            <div class="weather__item__desc">
              {{ weatherDesc }}
            </div>
        </div>
      </div>

    </div>
    </template>
    
    <script>
    
    
    export default {
      data() {
        return {
          dateArray: [],
          actualDay: '',
          actualTime: '',
          actualDayNumber: '',
          weatherObj: {},
          actualTemp: NaN,
          weatherDesc: '',
          weatherImgURl: ''
      
          
        }
      },
      methods: {
        
        getTimeAndTemperature() {
          let actualDate = new Date(Date.now());
          this.dateArray = actualDate.toString().split(' ');
          this.actualDay = this.dateArray[0],
          this.actualDayNumber = this.dateArray[2],
          this.actualTime = this.dateArray[4],
          this.actualTemp = this.weatherObj.main.temp,
          this.weatherDesc = this.weatherObj.weather[0].description,
          this.weatherImgURl = `<img src="https://openweathermap.org/img/wn/${this.weatherObj.weather[0].icon}@2x.png" alt="weather-picture" class="weather__img">`

    
    
        }, 
        async getWeaher() {
          //необходимо вписать координаты локации в lat и lon
          const url = 'https://api.openweathermap.org/data/2.5/forecast?lat=59.355920&lon=24.572355&appid=97d065b72e4ce3b9757c945c97ee45c3&units=metric&lang=ru';
          const options = {
          method: 'GET',
        };
    
          await fetch(url, options)
            .then(response => response.json())
            .then(data => this.weatherObj = data.list[0])
            .catch(error => console.error(error));
              }
    
      },
      created() {
        this.getWeaher();
        
      },
      mounted() {
        setInterval(() => {
          this.getTimeAndTemperature()
        }, 1000);
    
        setInterval(() => {
          this.getWeaher()
        }, 10800000)
    
    
      }
    }
    </script>
    
    <style>
    .info {
      display: flex;
      flex-direction: column;
      background: #d1cfcf;
      
      
      
}
    .time {
      font-size: 40px;
      text-align: end;
      
    }
    .weather {
      display: flex;
      justify-content: flex-end;
      align-items: flex-end;
      flex-direction: column;

    }
    .weather__item {
      display: flex;
      align-items: center;
      font-size: 40px;
    }

    .weather__item__value {
      text-align: center;
  
    }

    .weather__item__desc {
      font-size: 20px;
      width: 120px;
      text-align: right;
    }
    .weather__img {
      display: block;
      margin: 0 auto;
      height: 70px;
    }
    </style>
    