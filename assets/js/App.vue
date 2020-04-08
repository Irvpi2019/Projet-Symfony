<template>
<section class="ok">
    <div>
      <form action="">
        <h1>Search city</h1>
        <label for="city">City</label>
          <select id="city" name="city">
          <option value="tokyo">tokyo</option>
          <option value="osaka">osaka</option>
          <option value="kyoto">kyoto</option>
          <option value="kobe">kobe</option>
        </select>
        <input type="submit" value="Meteo">
      </form>
    </div>
  </section>
</template>

<script>
export default {
    methods: {
greet: function (event) {
// `this` inside methods point to the Vue instance
alert('Hello ' + this.name + '!')
// `event` is the native DOM event
alert(event.target.tagName)
}
}

}
</script>

<style>

</style>