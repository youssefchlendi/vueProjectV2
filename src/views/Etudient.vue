<template>
  <div class="eteudient">
    <button type="button" class="btn btn-success" @click="showCreateModal" >Add</button>
    <h1>Gestion des etudients</h1>
    <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">CIN</th>
      <th scope="col">Class</th>
      <th scope="col">NumIns</th>
      <th scope="col">Actions</th>      
    </tr>
  </thead>
  <tbody >
    <tr v-for="etudient in etudients" :key="etudient.id" >
      <td> {{ etudient.id }} </td>
      <td> {{ etudient.nom }} </td>
      <td> {{ etudient.prenom }} </td>
      <td> {{ etudient.cin }} </td>
      <td> {{ etudient.class }} </td>
      <td> {{ etudient.numins }} </td>
      <td>  </td>
    </tr>
  </tbody>
</table>
<CreateEtudientModal @show-create-modal="showCreateModal" @post-data="postData" />
    <!-- <pre>
        {{ this.classes }}
    </pre> -->
  </div>
</template>

<script>
import CreateEtudientModal from '../components/etudient/CreateEtudientModal.vue';
// @ is an alias to /src
import axios from "axios";
export default {
  name: "Home",
  components: {
      CreateEtudientModal,
  },
  data() {
    return {
      etudients:null,
    };
  },
  methods: {
    getAll(){
        axios
        .get("http://localhost:8080/testApi/api/etudient/read.php")
        .then((response) => (this.classes = response.data))
        .then(()=>{

          const tab=[];
          Object.keys(this.classes).forEach(key =>(
              this.classes[key].forEach(key=>(
                  tab.push(key)
              )
          )));
          this.etudients=tab;
        });
    },
    postData(arg) {
      let data;
      console.log(arg);
     if (typeof arg!=='undefined'){
       data=arg;
      }
        axios
        .post('http://localhost:8080/testApi/api/etudient/create.php', data)
        .then((res) => {
            console.log(res);
        }).then(()=>{
          this.getAll();
          this.showCreateModal(1);
        })
        ;
    },
    showCreateModal(){
        window.$('#createEtudient').hasClass("show")?window.$('#createEtudient').modal("hide"):window.$('#createEtudient').modal("show");
    },
    deleteData(id) {
        let data = {
            id: id,
        };
            let header = {
        };
        axios
        .post("http://localhost:8080/testApi/api/class/delete.php", data, header)
        .then((res) => {
            console.log(res);
        }).then(()=>{
            this.getAll();
        });
    }
  },
  mounted() {
      this.getAll();
  }
};

</script>
