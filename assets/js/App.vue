<template>
  <section>
    <div class="ok">
      <h1>Weather in the world</h1>
      <form class="form" v-on:submit.prevent="fetchMeteo">
        <div class="d-flex justify-content-around align-middle">
          <input id="city" name="city" class="form-control form-control-lg" type="text" placeholder="Searche your city">
          <button type="submit" value="Meteo" class="btn btn-secondary bg-info">
            Meteo
          </button>
        </div>
      </form>
      <div class="meteo">
        <p>{{ weather.main }}   {{ name }} </p>
        <p>{{ weather.icon }}</p>
        <p>{{ main.temp }} ({{ weather.description }})</p>

        <div class="header"></div>
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
        icon: ""
      },main:{
        temp:"",
      },name:""
      
    };
  },

  created() {
    /*this.fetchMeteo();*/
  },

  methods: {
    fetchMeteo() {
      let form = document.querySelector("form");
      let formData = new FormData(form);

      fetch("/apiData", {
        body: formData,
        method: "post"
      })

        .then(res => res.json())
        .then(data => {
          console.log(
            data.weather[0].main +
              "\n" +
              data.weather.description +
              "\n" +
              data.weather.icon +
              "\n" +
              data.main.temp +
              "\n" +
              data.sys.country +
              "\n" +
              data.name
          );
          this.weather.main = data.weather[0].main;
          this.weather.icon = data.weather[0].icon;
          this.weather.description = data.weather[0].description;
          this.main.temp = data.main.temp
          this.name = data.name
          let id = data.weather[0].icon;
          console.log(data)
          let imgURL = "http://openweathermap.org/img/wn/" + id + ".png";
          console.log(imgURL);
           var img = document.createElement("img");
          img.src = imgURL;
           var div = document.getElementById("header");
          div.appendChild(img);
        })
    }
  }
  
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

.meteo {
  position: absolute;
  top: 55%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 40%;
  height: 10%;
  font-size: 30px;
  font-family: 'Roboto', sans-serif;
  text-align: center;
  color: aliceblue;
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
