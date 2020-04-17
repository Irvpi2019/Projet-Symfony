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
      <div class="meteo">
        <div class="text">
          <p class="ppp">{{ weather.main }} {{ name }}</p>
          <p v-html="weather.icon"></p>
          <p>{{ main.temp }} {{ weather.description }}</p>
        </div>
        <div id="test"></div>
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
        icon: "",
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
          this.weather.icon =
            '<img src="http://openweathermap.org/img/wn/' +
            data.weather[0].icon +
            '.png" height="100px" width="100px">';
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

.meteo {
  position: absolute;
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
