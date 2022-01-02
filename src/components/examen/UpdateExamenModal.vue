<template>
  <div class="updateExamen">
<!-- Edit Modal -->
<div class="modal fade text-dark" id="editExamen" tabindex="-1" role="dialog" aria-labelledby="editExamenLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExamenLabel">Edit Examen</h5>
        <div>
          <button type="button"  @click="getOne(Pid)"><span class="material-icons">refresh</span></button>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showEditModal(1)">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="modal-body">
          <h3>IdMatiere</h3>
          <select v-model="idMatiere">
            <option v-for="matiere in Matiere" :selected="matiere.id==idMatiere" :key="matiere.id" :value="matiere.id">{{ matiere.intitule }}</option>
          </select>
          <h3>IdProf</h3>
          <select v-model="idProf">
            <option v-for="prof in profs" :selected="prof.id==idProf" :key="prof.id" :value="prof.id">{{ prof.nom+" "+prof.prenom }}</option>
          </select>
          <h3>Intitule</h3>
          <input type="text" required v-model="intitule" />
          <h3>Coefficient</h3>
          <input type="number" min="0" max="99999999" required v-model="coefficient" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showEditModal(1)">Close</button>
        <button type="button" class="btn btn-primary" @click="updateData(Pid)" >Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
</template>

<script>
import axios from "axios";

export default {
  name: "UpdateExamenModal",
  props: {
    Pid:Number,
  },
  emits:[
    "post-data",
    "show-edit-modal",
    "update-data"
  ],
  data(){
    return {
      id:"",
      idMatiere:null,
      idProf:null,
      intitule:null,
      coefficient:null,
      Matiere:null,
      profs:null,

    };
  },
  methods: {
    showEditModal(del){
        if (del==1){
          this.$emit('show-edit-modal',del);
          this.id=null;
          this.idMatiere=null;
          this.idProf=null;
          this.intitule=null;
          this.coefficient=null;
        }else{
          this.getOneE(del);
        }
    },
    getOne(id){
      let oneData=[];
      let tab={};
      axios
        .get("http://localhost/api/examen/read_one.php?id="+id)
        .then((response) => (oneData = response.data))
        .then(()=>{
          Object.keys(oneData).forEach((key) =>{
              tab[key] = oneData[key];
          });})
        .then(() =>{
            this.id=id;
            this.idMatiere=tab.idMatiere;
            this.idProf=tab.idProf;
            this.intitule=tab.intitule;
            this.coefficient=tab.coefficient;
          });
    },
    updateData(){
      this.$emit('update-data',{
            id:this.Pid,
            idMatiere:this.idMatiere,
            idProf:this.idProf,
            intitule:this.intitule,
            coefficient:this.coefficient!=null?parseFloat(this.coefficient):null,
      })
          this.id=null;
          this.idMatiere=null;
          this.idProf=null;
          this.intitule=null;
          this.coefficient=null;
    },
     getMatiere(){
      const tab=[];
      axios
        .get("http://localhost:8080/api/matiere/read.php")
        .then((response) => (this.Matiere = response.data))
        .then(()=>{
          Object.keys(this.Matiere).forEach(key =>(
              this.Matiere[key].forEach(key=>(
                  tab.push(key)
              )
          )));
        })
        .then(() =>{
          this.Matiere=tab;
        });
    },
    getAllProfs(){
        axios
        .get("http://localhost:8080/api/enseignant/read.php")
        .then((response) => (this.profs = response.data))
        .then(()=>{
            const tab=[];
            Object.keys(this.profs).forEach(key =>(
                this.profs[key].forEach(key=>(
                    tab.push(key)
                )
            )));
            this.profs=tab;
        });
    }
  },
  updated() {
  },
  mounted(){
    let i=true;
    if (i)
      this.getMatiere();
      this.getAllProfs();
    i=false;
  }
};
</script>

