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
            <td>
            <button type="button" class=" btn btn-danger" @click="deleteData(etudient.id)"><span class="material-icons">delete</span></button>
            <button type="button" class="mx-2 btn btn-warning" @click="showEditModal(etudient.id)"><span class="material-icons">edit</span></button>
            </td>
            </tr>
        </tbody>
</table>
<UpdateEtudientModal @show-edit-modal="showEditModal" @update-data="updateData" :Pid="Number(id)" />
<CreateEtudientModal @show-create-modal="showCreateModal" @post-data="postData" />
  </div>
</template>

<script>
import UpdateEtudientModal from '../components/etudient/UpdateEtudientModal.vue';
import CreateEtudientModal from '../components/etudient/CreateEtudientModal.vue';
// @ is an alias to /src
import axios from "axios";
export default {
  name: "Etudient",
  components: {
      CreateEtudientModal,
      UpdateEtudientModal
  },
  data() {
    return {
        id:null,
        etudients:null,
        etudient:null,
        abr:"",
        
    };
  },
  methods: {
    getAll(){
        axios
        .get("http://localhost:8080/api/etudient/read.php")
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
    postData(arg){
        let data;
        if (typeof arg!=='undefined'){
            data=arg;
        }
        axios
        .post('http://localhost:8080/api/etudient/create.php', data)
        .then((res) => {
            console.log(res);
        }).then(()=>{
            this.getAll();
            this.showCreateModal(1);
        });
    },
    showCreateModal(){
        window.$('#createEtudient').hasClass("show")?window.$('#createEtudient').modal("hide"):window.$('#createEtudient').modal("show");
    },
    deleteData(id){
        let data = {
            id: id,
        };
            let header = {
        };
        axios
        .post("http://localhost:8080/api/etudient/delete.php", data, header)
        .then((res) => {
            console.log(res);
        }).then(()=>{
            this.getAll();
        });
    },
    getOneE(id){
        let oneData=[];
        let tab={};
        axios
        .get("http://localhost/api/etudient/read_one.php?id="+id)
        .then((response) => (oneData = response.data))
        .then(()=>{
            Object.keys(oneData).forEach((key) =>{
            tab[key] = oneData[key];
        });})
        .then(() =>{
            this.etudient=tab;
        });
    },
    showEditModal(id){
        this.id=id;
        window.$('#editEtudient').hasClass("show")?window.$('#editEtudient').modal("hide"):window.$('#editEtudient').modal("show");
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
        .post("http://localhost:8080/api/etudient/update.php", data, header)
        .then((res) => {
            console.log(res);
        }).then(()=>{
            this.getAll();
            this.showEditModal(0);
        })

    },getOneClass(id){
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
            });
        this.abr=(tab.abbreviation)
    }
  },
  mounted() {
      this.getAll();
  }
};

</script>
