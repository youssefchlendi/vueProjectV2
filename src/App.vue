<template>
  <div id="nav">
     <!-- <router-link to="/">Home</router-link> | -->
    <!-- <router-link to="/about">About</router-link> | -->
    <!-- <router-link to="/etudient">Etudient</router-link> |
    <router-link to="/enseignant">Enseignant</router-link> |
    <router-link to="/matiere">Matiere</router-link> |
    <router-link to="/examen">Examen</router-link> |
    <router-link to="/class">Class</router-link> --> 
  </div>
  <router-view />
  <footer class="container py-5">
      <div class="row">
        <div class="col-12 col-md">
          <img class="m-0" src="assets/images/logo.png">
          <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
        </div>
        <div class="col-6 col-md">
          <h5>Features</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Routing</a></li>
            <li><a class="text-muted" href="#">Bootstrap</a></li>
            <li><a class="text-muted" href="#">Modals/drops</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Pages</h5>
          <ul class="list-unstyled text-small">
            <li><router-link class="text-muted" to="/">Home</router-link></li>
            <li><router-link class="text-muted" to="/">Shop</router-link></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="https://getbootstrap.com/">Bootstrap</a></li>
            <li><a class="text-muted" href="https://vuejs.org">Vuejs</a></li>
            <li><a class="text-muted" href="https://www.npmjs.com/package/">npm</a></li>
          </ul>
        </div>
      </div>
    </footer>
</template>
