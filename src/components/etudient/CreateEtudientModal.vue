<template>

  <div class="createEtudient">
<!-- Create Modal -->
<div class="modal fade" id="createEtudient" tabindex="-1" role="dialog" aria-labelledby="createEtudientLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createEtudientLabel">create Etudient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showCreateModal(1)">
          <span aria-hidden="true">&times;</span>
        </button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showCreateModal(1)">Close</button>
        <button type="button" class="btn btn-primary" @click="postData" >Save changes</button>
      </div>
    </div>
  </div>
</div>  </div>
</template>

<script>
export default {
  name: "CreateEtudientModal",
  props: {
  },
  data(){
      return {
        id:"",
        nom:"",
        prenom:"",
        CIN:"",
        classe:"",
        numIns:"",
      };
  },
  methods: {
      postData(){
        this.$emit('post-data',{
          nom:this.nom,
          prenom:this.prenom,
          cin:this.CIN,
          class:this.classe,
          numIns:this.numIns,  
      })},
      showCreateModal(del){
          if (del){
            this.id="";
            this.nom="";
            this.prenom="";
            this.CIN="";
            this.classe="";
            this.numIns="";
          }
          this.$emit('show-create-modal',{del})
      }
  }
};
</script>

