<template>
  <section>
    <div class="ok">
      <h1>Weather in the world</h1>
      <form class="form" v-on:submit.prevent="fetchMeteo">
        <div class="d-flex justify-content-around align-middle">
          <input
            id="city"
            name="city"
            class="form-control form-control-lg"
            type="text"
            placeholder="Searche your city"
          />
          <button type="submit" value="Meteo" class="btn btn-secondary bg-info">
            Meteo
          </button>
        </div>
      </form>
      <div id="mapid"></div>
      <div class="meteo">
        <div id="map"></div>
        <div class="meteoText">
          <div class="text">
            <p>{{ weather.main }} {{ name }}</p>
            <p v-html="weather.icon"></p>
            <p>{{ main.temp }} {{ weather.description }}</p>
          </div>
          <div id="test"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      /*weather: [],*/
      weather: {
        main: "",
        description: "",
        
      },
      coord:{
        lon:"",
        lat:"",
      },
      main: {
        temp: "",
      },
      name: "",
    };
  },

  created() {
    /*this.fetchMeteo();*/
  },

  methods: {
    fetchMeteo() {
      let form = document.querySelector("form");
      let formData = new FormData(form);

      let element = document.getElementById("test");
      element.classList.add("bgcolor");

      fetch("/apiData", {
        body: formData,
        method: "post",
      })
        .then((res) => res.json())
        .then((data) => {
          this.weather.main = data.weather[0].main;
          this.main.temp = data.main.temp.toFixed(0) + "C°";
          this.weather.description = "(" + data.weather[0].description + ")";
          this.name = data.name;
          this.weather.icon = '<img src="http://openweathermap.org/img/wn/' +data.weather[0].icon +'.png" height="100px" width="100px">';

          this.coord.lon = data.coord.lon;
          this.coord.lat = data.coord.lat;

          //console.log(lon);

          var mymap = L.map("mapid").setView([this.coord.lat, this.coord.lon], 8);
          L.tileLayer(
            "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaW1vdWxhIiwiYSI6ImNrOTg4ZmFodzAwYWMzbnAyendnZnkyZ2oifQ.ynaflBVc-HcqiGc9hN36fQ",
            {
              attribution:
                'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
              maxZoom: 18,
              id: "mapbox/streets-v11",
              tileSize: 512,
              zoomOffset: -1,
              accessToken: "your.mapbox.access.token",
            }
          ).addTo(mymap);
          var marker = L.marker([this.coord.lat, this.coord.lon]).addTo(mymap);
                   
          function onMapClick(e) {
            alert("You clicked the map at " + name);
          }

          mymap.on("click", onMapClick);
          var popup = L.popup();

          function onMapClick(e) {
            popup
              .setLatLng(e.latlng)
              .setContent("You clicked the map at " + e.latlng.toString())
              .openOn(mymap);
          }

          mymap.on("click", onMapClick);
        });
    },
  },
};
</script>

<style scoped>
section {
  height: 100vh;
  width: 100;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
  background-size: cover;
  background-image: url("../../assets/img/city.jpg");
}

.mylocation {
    position: absolute;
    bottom: 10%;
    left: 50%;
    transform: translate(-50%, 10%);
    -webkit-border-radius: 7;
    -moz-border-radius: 7;
    border-radius: 7px;
    font-family: Arial;
    color: #1f628d;
    font-size: 30px;
    background: #ffffff;
    padding: 10px 20px 10px 20px;
    border: solid #1f628d 2px;
    text-decoration: none;
}

.mylocation:hover {
    background: #1f628d;
    text-decoration: none;
    color: #ffffff;
    border: none;
}

#mapid {
  height:  450px;
  width: 550px;
  position: absolute;
  top: 70%;
  transform: translate(0%, -50%);

}
.meteo {
  position: absolute;
  display: flex;
  top: 70%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.text {
  font-family: "Roboto", sans-serif;
  text-align: center;
  color: white;
  font-size: 30px;
}

.bgcolor {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100%;
  background-color: #007aac;
  opacity: 0.5;
  border-radius: 9px;
  z-index: -1;
}

.form {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #181818;
  width: 50%;
  height: 10%;
}
form .h2 {
  font-size: 30px;
}

h1 {
  text-align: center;
  position: absolute;
  top: 15%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #ff5e57;
  font-size: 60px;
  font-family: "Roboto", sans-serif;
}
</style>
