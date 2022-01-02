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
            <select v-model="idMatiere">
              <option v-for="matiere in Matiere" :key="matiere.id" :value="matiere.id">{{ matiere.intitule }}</option>
            </select>
            <h3>IdProf</h3>
            <select v-model="idProf">
              <option v-for="prof in profs" :key="prof.id" :value="prof.id">{{ prof.nom+" "+prof.prenom }}</option>
            </select>              
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
import axios from "axios";

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
        Matiere:null,
        profs:null,
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
  mounted(){
    let i=true;
    if (i)
      this.getMatiere();
      this.getAllProfs();
    i=false;
  }
};
</script>

