<template>
  <div id="app">
    <ObjectList />
    <router-view />
    <!-- <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div> -->
  </div>
</template>

<script>
// @ is an alias to /src
import ObjectList from "@/components/ObjectList.vue"

export default {
  name: "home",
  components: {
    ObjectList,
  },
  mounted () {
    this.$store.dispatch('getObjectsList');
  },
  watch: {
    '$store.state.apiUrl' (v) {
      this.$store.dispatch('getObjectsList');
    },
    '$store.state.currentObjectName' (v) {
      // this.$store.dispatch('getObjectsList');
      this.$router.push({ name: 'ObjectTable', params: { id: v}});
    },
  },
};
</script>

<style lang="scss">
html,
body {
  height: 100%;
}
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  display: flex;
  height: 100%;
}
#nav {
  padding: 30px;
  a {
    font-weight: bold;
    color: #2c3e50;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
