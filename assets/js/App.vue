<template>
  <section>
    <div class="ok">
      <h1>Bienvenue sur le site météo Michiyukibun</h1>
      <form class="form" v-on:submit.prevent="fetchMeteo">
        <h2 class="text-light bg-dark">Search city</h2>
        <label for="city">City</label>
        <select id="city" name="city">
          <option value="tokyo">tokyo</option>
          <option value="osaka">osaka</option>
          <option value="kyoto">kyoto</option>
          <option value="kobe">kobe</option>
        </select>
        <input type="submit" value="Meteo">
      </form>
      {{ weather.main }}

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
    };
  },
  created() {
    /*this.fetchMeteo();*/
  },

  methods: {
    fetchMeteo() {
      let form = document.querySelector('form');
      let formData = new FormData(form);
      fetch("/apiData",
      {
        body: formData,
        method: "post"
        })
        .then((res) => res.json())
        .then((data) => {
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
          console.log(data)
          
        })
        .catch((error) => {
          alert("error: " + error);
        });
    },
  },
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

.form {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #181818;
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
