<template>
  <div id="app">
    <h1>Admin Panel</h1>
    <DomainList/>
  </div>
</template>

<script>
import DomainList from "@/components/DomainList.vue";

export default {
  name: "App",
  components: {
    DomainList
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
