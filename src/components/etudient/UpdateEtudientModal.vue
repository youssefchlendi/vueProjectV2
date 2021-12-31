<template>
<button type="button" class="btn" @click="test">btn</button>
  <div class="updateEtudient">
<!-- Edit Modal -->
<div class="modal fade text-dark" id="editEtudient" tabindex="-1" role="dialog" aria-labelledby="editEtudientLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEtudientLabel">Edit Etudient</h5>
        <div>

                <button type="button"  @click="getOne(Pid)"><span class="material-icons">refresh</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showEditModal(1)">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>

      </div>
      <div class="modal-body">
    <h3>Nom</h3>
    <input type="text" required v-model="nom" />
        <h3>Prenom</h3>
    <input type="text" required v-model="prenom" />
        <h3>CIN</h3>
    <input type="text" required v-model="CIN" />
        <h3>Class</h3>
    <input type="text" required v-model="classe" />
        <h3>NumIns</h3>
    <input type="text" required v-model="numIns" />
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
  name: "UpdateClassModal",
  props: {
    Pid:Number,
  }
    ,emits:[
      "post-data",
      "show-edit-modal",
      "update-data"
  ],
  data(){
      return {
        id:"",
        nom:null,
        prenom:null,
        CIN:null,
        classe:null,
        numIns:null,
      };
  },
  methods: {
      test(){
        console.log(this.Pid);
      },
      showEditModal(del){
          if (del==1){
            this.$emit('show-edit-modal',del);
            this.id=null;
            this.nom=null;
            this.prenom=null;
            this.CIN=null;
            this.classe=null;
            this.numIns=null;
          }else{
            this.getOneE(del);
          }
      },
      getOne(id){
        let oneData=[];
        let tab={};
        axios
          .get("http://localhost/testApi/api/etudient/read_one.php?id="+id)
          .then((response) => (oneData = response.data))
          .then(()=>{
            Object.keys(oneData).forEach((key) =>{
                tab[key] = oneData[key];
            });})
          .then(() =>{
              console.log(tab);
              this.id=id;
              this.nom=tab.nom;
              this.prenom=tab.prenom;
              this.CIN=tab.cin;
              this.classe=tab.class;
              this.numIns=tab.numIns;
            });
      },
      updateData(id){
        console.log(id);
        this.$emit('update-data',{
              id:this.Pid,
              nom:this.nom,
              prenom:this.prenom,
              CIN:this.cin,
              classe:this.classe,
              numIns:this.numIns,
        })
            this.id=null;
            this.nom=null;
            this.prenom=null;
            this.CIN=null;
            this.classe=null;
            this.numIns=null;
      }
  },
  updated() {
  }
};
</script>

