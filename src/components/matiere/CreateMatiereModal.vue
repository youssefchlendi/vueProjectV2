<template>

  <div class="createMatiere">
    <!-- Create Modal -->
    <div class="modal fade" id="createMatiere" tabindex="-1" role="dialog" aria-labelledby="createMatiereLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createMatiereLabel">create Matiere</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showCreateModal(1)">
              <span aria-hidden="true">&times;</span>
            </button>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showCreateModal(1)">Close</button>
            <button type="button" class="btn btn-primary" @click="postData" >Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreateMatiereModal",
  props: {
  },
  data(){
      return {
        id:"",
        intitule:"",
        coefficient:"",
        idProf:"",
      };
  },
  methods: {
    postData(){
      this.$emit('post-data',{
        intitule:this.intitule,
        coefficient:this.coefficient,
        idProf:this.idProf, 
      })
        this.id="";
        this.intitule="";
        this.coefficient="";
        this.idProf="";

    },
    showCreateModal(del){
      if (del){
        this.id="";
        this.intitule="";
        this.coefficient="";
        this.idProf="";
      }
      this.$emit('show-create-modal',{del})
    }
  }
};
</script>

