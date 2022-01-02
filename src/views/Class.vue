<template>
  <div class="class">
      <button type="button" class="btn btn-success" @click="showCreateModal" >Add</button>
    <h1>Gestion des classes</h1>
    <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Intitule</th>
      <th scope="col">Abbreviation</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody >
    <tr v-for="classe in this.classes" :key="classe.id">
      <th scope="row">{{classe.id}}</th>
      <td>{{classe.intitule}}</td>
      <td>{{classe.abbreviation}}</td>
      <td>
        <button type="button" class=" btn btn-danger" @click="deleteData(classe.id)"><span class="material-icons">delete</span></button>
        <button type="button" class="mx-2 btn btn-warning" @click="showEditModal(classe.id)"><span class="material-icons">edit</span></button>

      </td>
    </tr>
  </tbody>
</table>
<UpdateClassModal @show-edit-modal="showEditModal" @update-data="updateData" :idd="id" :intituled="intituleE" :abrd="abrE" />


<CreateClassModal @show-create-modal="showCreateModal" @post-data="postData" />
  </div>
</template>

<script>
// @ is an alias to /src
import axios from "axios";
import CreateClassModal from '../components/class/CreateClassModal.vue';
import UpdateClassModal from '../components/class/UpdateClassModal.vue';
export default {
  name: "Class",
  components: {
    CreateClassModal,
    UpdateClassModal
  },
  data() {
    return {
      id:"",
      intitule: "",
      abr: "",
      intituleE: "",
      abrE: "",
      selected:null,
      classes: null,
    };
  },
  methods: {
      getAll(){
        axios
        .get("http://localhost:8080/api/class/read.php")
        .then((response) => (this.classes = response.data))
        .then(()=>{
          const tab=[];
          Object.keys(this.classes).forEach(key =>(
              this.classes[key].forEach(key=>(
                  tab.push(key)
              )
          )));
          this.classes=tab;
        });

    },getOneE(id){
      let oneData=[];
                let tab={};
      axios
        .get("http://localhost/api/class/read_one.php?id="+id)
        .then((response) => (oneData = response.data))
        .then(()=>{
          Object.keys(oneData).forEach((key) =>{
               tab[key] = oneData[key];
          });
}).then(() =>{
  this.id=id;
  this.abrE=tab.abbreviation;
  this.intituleE=tab.intitule;
});
    }
    ,
    postData(arg) {
      let data;
     if (typeof arg!=='undefined'){
       data=arg;
      }

        axios
        .post('http://localhost:8080/api/class/create.php', data)
        .then((res) => {
            console.log(res);
        }).then(()=>{
          this.getAll();
          this.showCreateModal(1);
        })
        ;
        
        
    },deleteData(id) {
        let data = {
        id: id,
        };
        let header = {
            };
        axios
        .post("http://localhost:8080/api/class/delete.php", data, header)
        .then((res) => {
            console.log(res);
        }).then(()=>{
          this.getAll();
        })
        ;
        
        
    },
    showEditModal(del){
        if(del){
          this.intitule="";
          this.abr="";
        }
        this.getOneE(del);
        window.$('#editClass').hasClass("show")?window.$('#editClass').modal("hide"):window.$('#editClass').modal("show");
    },showCreateModal(del){
              if(del){
          this.intitule="";
          this.abr="";
        }
                  window.$('#createClass').hasClass("show")?window.$('#createClass').modal("hide"):window.$('#createClass').modal("show");

    },
    updateData(arg){
      let data;
     if (typeof arg!=='undefined'){
       data=arg;
      }
      console.log(arg);
        let header = {
        "Access-Control-Allow-Origin": "*",
        Accept: "*/*",
        Connection: "keep-alive",
        "Content-type": "application/json",
            };
        axios
        .post("http://localhost:8080/api/class/update.php", data, header)
        .then((res) => {
            console.log(res);
        }).then(()=>{
          this.getAll();
          this.showEditModal(0);
        })

    },
    beforeUpdate(){

    }
  },
  mounted() {
      this.getAll();
  }
};

</script>
