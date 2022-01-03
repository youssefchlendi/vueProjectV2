<template>
  <div id="navbar">
    <nav class="navbar shadow-lg fixed-top navbar-expand-lg navbar-light bg-light px-4">
      <a class="navbar-brand" href="#">
        <img width="50" height="50" src="../assets/logo.png" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        @click="show"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav" >
          <li class="nav-item active">
            <router-link class="nav-link" to="/">
              Home<span class="mx-2 material-icons">home</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/etudient">
              Etudient<span class="mx-2 material-icons">person</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/enseignant">
              Enseignant<span class="mx-2 material-icons">school</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/matiere">
              Matiere<span class="mx-2 material-icons">menu_book</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/examen">
              Examen<span class="mx-2 material-icons">quiz</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/class">
              Class<span class="mx-2 material-icons">class</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/search">
              Search<span class="mx-2 material-icons">search</span>
            </router-link>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  name: "navBar",
  methods: {
    show() {
      window.$(".collapse").hasClass("show")
        ? window.$(".collapse").collapse("hide")
        : window.$(".collapse").collapse("show");
    },
  },
};
</script>
<style scoped>
#navbar{
  margin-bottom:100px;
}
</style>