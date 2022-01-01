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
          <input type="text" required v-model="idMatiere" />
          <h3>IdProf</h3>
          <input type="text" required v-model="idProf" />
          <h3>Intitule</h3>
          <input type="text" required v-model="intitule" />
          <h3>Coefficient</h3>
          <input type="number" min="10000000" max="99999999" required v-model="coefficient" />
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
        .get("http://localhost/testApi/api/examen/read_one.php?id="+id)
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
            coefficient:this.coefficient,
      })
          this.id=null;
          this.idMatiere=null;
          this.idProf=null;
          this.intitule=null;
          this.coefficient=null;
    }
  },
  updated() {
  }
};
</script>

