<template>
  <navBar />
  <div class="home m-4">
<form action="javascript:" class="search-bar">
	<input type="search" name="search" pattern=".*\S.*" @keypress="getAll"  required v-model="search">
	<button class="search-btn"  @click="getAll" type="submit">
		<span>Search</span>
	</button>
</form>
<p class="text-center" >
  <button class="btn btn-success p-2 m-2" type="button" @click="showCol(1)" >Classes</button>
  <button class="btn btn-success p-2 m-2" type="button" @click="showCol(2)" >Enseignant</button>
  <button class="btn btn-success p-2 m-2" type="button" @click="showCol(3)" >Etudients</button>
  <button class="btn btn-success p-2 m-2" type="button" @click="showCol(4)" >Matiere</button>
  <button class="btn btn-success p-2 m-2" type="button" @click="showCol(5)" >Examens</button>
</p>
    <div class="collapse multi-collapse" id="coll1">
      <div class="card card-body">
<h1>Classes</h1>
<table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Intitule</th>
          <th scope="col">Abbreviation</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="classe in this.classes" :key="classe.id">
          <th scope="row">{{ classe.id }}</th>
          <td>{{ classe.intitule }}</td>
          <td>{{ classe.abbreviation }}</td>
        </tr>
      </tbody>
    </table>
          </div>
    </div>
    <div class="collapse multi-collapse" id="coll2">
      <div class="card card-body">
    <h1>Enseignant</h1>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">CIN</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="enseignant in enseignants" :key="enseignant.id">
          <td>{{ enseignant.id }}</td>
          <td>{{ enseignant.nom }}</td>
          <td>{{ enseignant.prenom }}</td>
          <td>{{ enseignant.cin }}</td>
          
        </tr>
      </tbody>
    </table>
    </div></div>
        <div class="collapse multi-collapse" id="coll3">
      <div class="card card-body">

    <h1>Etudients</h1>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">CIN</th>
          <th scope="col">Class</th>
          <th scope="col">NumIns</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="etudient in etudients" :key="etudient.id">
          <td>{{ etudient.id }}</td>
          <td>{{ etudient.nom }}</td>
          <td>{{ etudient.prenom }}</td>
          <td>{{ etudient.cin }}</td>
          <td>{{ etudient.class }}</td>
          <td>{{ etudient.numins }}</td>
        </tr>
      </tbody>
    </table>
    </div></div>
        <div class="collapse multi-collapse" id="coll4">
      <div class="card card-body">

    <h1>Matiere </h1>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Intitule</th>
          <th scope="col">Coefficient</th>
          <th scope="col">IdProf</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="matiere in matieres" :key="matiere.id">
          <td>{{ matiere.id }}</td>
          <td>{{ matiere.intitule }}</td>
          <td>{{ matiere.coefficient }}</td>
          <td>{{ matiere.idProf }}</td>
        </tr>
      </tbody>
    </table>
    </div></div>
        <div class="collapse multi-collapse" id="coll5">
      <div class="card card-body">

    <h1>Examens</h1>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">IdMatiere</th>
          <th scope="col">IdProf</th>
          <th scope="col">Intitule</th>
          <th scope="col">Coefficient</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="examen in examens" :key="examen.id">
          <td>{{ examen.id }}</td>
          <td>{{ examen.idMatiere }}</td>
          <td>{{ examen.idProf }}</td>
          <td>{{ examen.intitule }}</td>
          <td>{{ examen.coefficient }}</td>
          
        </tr>
      </tbody>
    </table>
    </div></div>
  </div>
</template>

<script>
// @ is an alias to /src
import axios from "axios";
import navBar from "../components/navbar.vue";
export default {
  name: "Search",
  components: {
    navBar,
  },
  data() {
    return {
      search:"",
      classes:null,
      enseignants:null,
      etudients:null,
      matieres:null,
      examens:null,
    }
  },
  methods: {
    getClasses() {
            let stat;
      axios.get("http://localhost:8085/api/class/search.php?s="+this.search)
      .then((response) => {
        this.classes = response.data;
        stat=response.status;
        console.log(stat);
      })
      .then(() => {
        const tab = [];
        Object.keys(this.classes).forEach((key) =>
          this.classes[key].forEach((key) => tab.push(key))
        );
        if (stat==404){
          this.classes = null;
        }else{
          this.classes = tab;
        }
      })
      .catch((error) => {
        console.log(error);
      });
    },
    getEnseignants() {
            let stat;
      axios.get("http://localhost:8085/api/enseignant/search.php?s="+this.search)
      .then((response) => {
        this.enseignants = response.data;
        stat=response.status;
        console.log(stat);
      })
      .then(() => {
        const tab = [];
        Object.keys(this.enseignants).forEach((key) =>
          this.enseignants[key].forEach((key) => tab.push(key))
        );
        if (stat==404){
          this.enseignants = null;
        }else{
          this.enseignants = tab;
        }
      })
      .catch((error) => {
        console.log(error);
      });
    },
    getEtudient() {
            let stat;
      axios.get("http://localhost:8085/api/etudient/search.php?s="+this.search)
      .then((response) => {
        this.etudients = response.data;
        stat=response.status;
        console.log(stat);
      })
      .then(() => {
        const tab = [];
        Object.keys(this.etudients).forEach((key) =>
          this.etudients[key].forEach((key) => tab.push(key))
        );
        if (stat==404){
          this.etudients = null;
        }else{
          this.etudients = tab;
        }
      })
      .catch((error) => {
        console.log(error);
      });
    },
    getMatiere() {
            let stat;
      axios.get("http://localhost:8085/api/matiere/search.php?s="+this.search)
      .then((response) => {
        this.matieres = response.data;
        stat=response.status;
        console.log(stat);
      })
      .then(() => {
        const tab = [];
        Object.keys(this.matieres).forEach((key) =>
          this.matieres[key].forEach((key) => tab.push(key))
        );
        if (stat==404){
          this.matieres = null;
        }else{
          this.matieres = tab;
        }
      })
      .catch((error) => {
        console.log(error);
      });
    },
    getExamen() {
            let stat;
      axios.get("http://localhost:8085/api/examen/search.php?s="+this.search)
      .then((response) => {
        this.examens = response.data;
        stat=response.status;
        console.log(stat);
      })
      .then(() => {
        const tab = [];
        Object.keys(this.examens).forEach((key) =>
          this.examens[key].forEach((key) => tab.push(key))
        );
        if (stat==404){
          this.examens = null;
        }else{
          this.examens = tab;
        }
      })
      .catch((error) => {
        console.log(error);
      });
    },
    getAll(){
      this.classes=this.enseignants=this.etudients=this.matieres=this.examens=null;
      this.getClasses();
      this.getEnseignants();
      this.getEtudient();
      this.getMatiere();
      this.getExamen();
    },
    showCol(id){
      window.$("#coll"+id).hasClass("show")
        ? window.$("#coll"+id).collapse("hide")
        : window.$("#coll"+id).collapse("show")
    }
  },
  updated() {
  },
};

</script>
<style scoped>
* {
	border: 0;
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}
:root {
	font-size: calc(16px + (24 - 16)*(100vw - 320px)/(1920 - 320));
}
body, button, input {
	font: 1em Hind, sans-serif;
	line-height: 1.5em;
}
body, input {
	color: #171717;
}
body, .search-bar {
	display: flex;
}
body {
	background: #f1f1f1;
	height: 100vh;
}
.search-bar input,
.search-btn, 
.search-btn:before, 
.search-btn:after {
	transition: all 0.25s ease-out;
}
.search-bar input,
.search-btn {
	width: 3em;
	height: 3em;
}
.search-bar input:invalid:not(:focus),
.search-btn {
	cursor: pointer;
}
.search-bar,
.search-bar input:focus,
.search-bar input:valid  {
	width: 100%;
}
.search-bar input:focus,
.search-bar input:not(:focus) + .search-btn:focus {
	outline: transparent;
}
.search-bar {
	margin: auto;
	padding: 1.5em;
	justify-content: center;
	max-width: 30em;
}
.search-bar input {
	background: transparent;
	border-radius: 1.5em;
	box-shadow: 0 0 0 0.4em #171717 inset;
	padding: 0.75em;
	transform: translate(0.5em,0.5em) scale(0.5);
	transform-origin: 100% 0;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
}
.search-bar input::-webkit-search-decoration {
	-webkit-appearance: none;
}
.search-bar input:focus,
.search-bar input:valid {
	background: #fff;
	border-radius: 0.375em 0 0 0.375em;
	box-shadow: 0 0 0 0.1em #d9d9d9 inset;
	transform: scale(1);
}
.search-btn {
	background: #171717;
	border-radius: 0 0.75em 0.75em 0 / 0 1.5em 1.5em 0;
	padding: 0.75em;
	position: relative;
	transform: translate(0.25em,0.25em) rotate(45deg) scale(0.25,0.125);
	transform-origin: 0 50%;
}
.search-btn:before, 
.search-btn:after {
	content: "";
	display: block;
	opacity: 0;
	position: absolute;
}
.search-btn:before {
	border-radius: 50%;
	box-shadow: 0 0 0 0.2em #f1f1f1 inset;
	top: 0.75em;
	left: 0.75em;
	width: 1.2em;
	height: 1.2em;
}
.search-btn:after {
	background: #f1f1f1;
	border-radius: 0 0.25em 0.25em 0;
	top: 51%;
	left: 51%;
	width: 0.75em;
	height: 0.25em;
	transform: translate(0.2em,0) rotate(45deg);
	transform-origin: 0 50%;
}
.search-btn span {
	display: inline-block;
	overflow: hidden;
	width: 1px;
	height: 1px;
}

/* Active state */
.search-bar input:focus + .search-btn,
.search-bar input:valid + .search-btn {
	background: #008cff;
	border-radius: 0 0.375em 0.375em 0;
	transform: scale(1);
}
.search-bar input:focus + .search-btn:before, 
.search-bar input:focus + .search-btn:after,
.search-bar input:valid + .search-btn:before, 
.search-bar input:valid + .search-btn:after {
	opacity: 1;
}
.search-bar input:focus + .search-btn:hover,
.search-bar input:valid + .search-btn:hover,
.search-bar input:valid:not(:focus) + .search-btn:focus {
	background: #0c48db;
}
.search-bar input:focus + .search-btn:active,
.search-bar input:valid + .search-btn:active {
	transform: translateY(1px);
}

@media screen and (prefers-color-scheme: dark) {
	body, input {
		color: #f1f1f1;
	}
	body {
		background: #171717;
	}
	.search-bar input {
		box-shadow: 0 0 0 0.4em #3a3838 inset;
	}
	.search-bar input:focus,
	.search-bar input:valid {
		background: #3d3d3d;
		box-shadow: 0 0 0 0.1em #3d3d3d inset;
	}
	.search-btn {
		background: #3a3838;
	}
}
</style>