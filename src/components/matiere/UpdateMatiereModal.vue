<template>
  <div class="updateMatiere">
<!-- Edit Modal -->
<div class="modal fade text-dark" id="editMatiere" tabindex="-1" role="dialog" aria-labelledby="editMatiereLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMatiereLabel">Edit Matiere</h5>
        <div>
          <button type="button"  @click="getOne(Pid)"><span class="material-icons">refresh</span></button>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showEditModal(1)">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="modal-body">
        <h3>Intitule</h3>
        <input type="text" required v-model="intitule" />
        <h3>Coefficient</h3>
        <input type="number" required v-model="coefficient" />
        <h3>IdProf</h3>
        <input type="number" required v-model="idProf" />
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
  name: "updateMatiereModal",
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
      intitule:"",
      coefficient:"",
      idProf:"",
    };
  },
  methods: {
    showEditModal(del){
        if (del==1){
          this.$emit('show-edit-modal',del);
          this.id=null;
          this.intitule=null;
          this.coefficient=null;
          this.idProf=null;
        }else{
          this.getOneE(del);
        }
    },
    getOne(id){
      let oneData=[];
      let tab={};
      axios
        .get("http://localhost/testApi/api/matiere/read_one.php?id="+id)
        .then((response) => (oneData = response.data))
        .then(()=>{
          Object.keys(oneData).forEach((key) =>{
              tab[key] = oneData[key];
          });})
        .then(() =>{
            this.id=id;
            this.intitule=tab.intitule;
            this.coefficient=tab.coefficient;
            this.idProf=tab.idProf;
          });
    },
    updateData(){
      this.$emit('update-data',{
            id:this.Pid,
            intitule:this.intitule,
            coefficient:this.coefficient,
            idProf:this.idProf,
      })
          this.id=null;
          this.intitule=null;
          this.coefficient=null;
          this.idProf=null;
    }
  },
  updated() {
  }
};
</script>

