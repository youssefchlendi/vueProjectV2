<template>

  <div class="updateClass">
<!-- Edit Modal -->
<div class="modal fade text-dark" id="editClass" tabindex="-1" role="dialog" aria-labelledby="editClassLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editClassLabel">Edit Class</h5>
        <div>

                <button type="button"  @click="refresh()"><span class="material-icons">refresh</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showEditModal(1)">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>

      </div>
      <div class="modal-body">
    <h3>Intitule</h3>
    <input type="text" required v-model="intitule" />
    <h3>abravtion</h3>
    <input type="text" required v-model="abr" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showEditModal(1)">Close</button>
        <button type="button" class="btn btn-primary" @click="updateData(idd)" >Save changes</button>
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
      idd:String,
      intituled:String,
      abrd:String
  }
    ,emits:[
      "post-data",
      "show-edit-modal",
      "update-data"
  ],
  data(){
      return {
          test1AsData: {id:this.idd,int:this.intituled,abr:this.abrd},
          id:this.idd,
          intitule:this.intituled,
          abr:this.abrd,
      };
  },
  methods: {
    refresh(){
      this.id=this.idd;
          this.intitule=this.intituled;
          this.abr=this.abrd;

    },
      showEditModal(del){
          if (del==1){
              this.$emit('show-edit-modal',del)
          }else{
            this.getOneE(del);
          }
      },
      getOneE(id){
      let oneData=[];
      let tab={};
      axios
        .get("http://localhost/testApi/api/class/read_one.php?id="+id)
        .then((response) => (oneData = response.data))
        .then(()=>{
          Object.keys(oneData).forEach((key) =>{
               tab[key] = oneData[key];
          });})
        .then(() =>{
            this.id=id;
            this.abr=tab.abbreviation;
            this.intitule=tab.intitule;
            })
        .then(() =>{
            this.refresh()

        })
        .then(()=>{
                    this.$emit('show-edit-modal',id)

        });
      },
      updateData(id){
        this.$emit('update-data',{
            id:id,
            intitule:this.intitule,
            abbreviation:this.abr
        })
        this.id=this.intitule=this.abr="";
      }
  },
  updated() {
  }
};
</script>

