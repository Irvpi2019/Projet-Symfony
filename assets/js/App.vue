<template>
  <section>
    <div class="ok">
      <h1>Search the weather in Japan Citys</h1>
      <form class="form" v-on:submit.prevent="fetchMeteo">
        <div class="d-flex justify-content-around align-middle">
          <select id="city" name="city" class="form-control form-control-lg">
            <option value="tokyo">tokyo</option>
            <option value="osaka">osaka</option>
            <option value="kyoto">kyoto</option>
            <option value="kobe">kobe</option>
          </select>
          <button type="submit" value="Meteo" class="btn btn-secondary bg-info">Meteo</button>
        </div>
      </form>
      <div class="meteo">
        <p>{{ weather.main }} {{  weather.icon  }}</p>
        
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
      }
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
          let id = data.weather[0].icon;
          let imgURL = "http://openweathermap.org/img/wn/" + id + ".png"
          console.log (id);
        })
        .catch(error => {
          alert("error: " + error);
        });
    }
  }
};
</script>

<style scoped>
section {
  height: 100vh;
  width: 100%;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
  background-image: url("../../assets/img/japon.jpg");
}

.meteo{
  position: absolute;
  top: 70%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 40%;
  height: 10%;
  background-color: blanchedalmond;
  border-radius:3px ;
}

.form {
  position: absolute;
  top: 50%;
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
  color: #181818;
  font-size: 60px;
  font-family: "japan", sans-serif;
}
</style>
