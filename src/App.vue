<template>
  <div id="nav">
     <!-- <router-link to="/">Home</router-link> | -->
    <!-- <router-link to="/about">About</router-link> | -->
    <!-- <router-link to="/etudient">Etudient</router-link> |
    <router-link to="/enseignant">Enseignant</router-link> |
    <router-link to="/matiere">Matiere</router-link> |
    <router-link to="/examen">Examen</router-link> |
    <router-link to="/class">Class</router-link> --> 
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img width="50" height="50" src="./assets/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse"  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <router-link class="nav-link" to="/">Home</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/etudient">Etudient</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/enseignant">Enseignant</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/matiere">Matiere</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/examen">Examen</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/class">Class</router-link>
      </li>
    </ul>
  </div>
</nav>
  </div>
  <router-view />
</template>
