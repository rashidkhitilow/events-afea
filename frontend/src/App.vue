<template>
  <ProjectList v-show="false"/>
  <router-view :key="$route.fullPath"></router-view>
</template>

<script>
import ProjectList from "@/components/EventList.vue";

export default {
  name: 'App',
  components: {
    ProjectList
  }
}
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
