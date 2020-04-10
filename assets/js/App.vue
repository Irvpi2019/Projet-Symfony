<template>
  <section>
    <div class="ok">
      <h1>Bienvenue sur le site météo Michiyukibun</h1>
      <form class="form" action="">
        <h2 class="text-light bg-dark">Search city</h2>
        <label for="city">City</label>
        <select id="city" name="city">
          <option value="tokyo">tokyo</option>
          <option value="osaka">osaka</option>
          <option value="kyoto">kyoto</option>
          <option value="kobe">kobe</option>
        </select>
      </form>

      <button v-on:click="counter += 1">Add 1</button>
      <p>The button above has been clicked {{ counter }} {{ name }}times.</p>
    </div>

  </section>
</template>

<script>
export default {
  data() {
    return {
      weather: [],
      weather: {
        main: "",
        description: "",
        icon: "",
      },
    counter:0,
    name:"",
    };
  },
  created() {
    this.fetchMeteo();
  },

  methods: {
    fetchMeteo() {
      fetch("/apiData")
        .then((res) => res.json())
        .then((data) => {
          console.log(
            data.weather.main +
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
