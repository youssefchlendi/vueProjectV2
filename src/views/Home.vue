<template>
  <div class="home">
    <navBar />
    <img alt="Vue logo" src="../assets/logo.png" />
  </div>
</template>

<script>
// @ is an alias to /src
import navBar from "../components/navbar.vue";
export default {
  name: "Home",
  components: {
    navBar,
  },
};
</script>
