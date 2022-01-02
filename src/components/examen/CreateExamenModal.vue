<template>

  <div class="CreateExamen">
    <!-- Create Modal -->
    <div class="modal fade" id="CreateExamen" tabindex="-1" role="dialog" aria-labelledby="CreateExamenLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="CreateExamenLabel">create Examen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showCreateModal(1)">
              <span aria-hidden="true">&times;</span>
            </button>
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
  name: "CreateExamenModal",
  props: {
  },
  data(){
      return {
        idMatiere:"",
        idProf:"",
        intitule:"",
        coefficient:"",
      };
  },
  methods: {
    postData(){
      this.$emit('post-data',{
        idMatiere:this.idMatiere,
        idProf:this.idProf,
        intitule:this.intitule, 
        coefficient:parseFloat(this.coefficient), 
      })
        this.idMatiere="";
        this.idProf="";
        this.intitule="";
        this.coefficient="";

    },
    showCreateModal(del){
      if (del){
        this.idMatiere="";
        this.idProf="";
        this.intitule="";
        this.coefficient="";
      }
      this.$emit('show-create-modal',{del})
    }
  }
};
</script>

