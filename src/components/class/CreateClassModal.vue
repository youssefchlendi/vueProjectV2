<template>

  <div class="createClass">
<!-- Create Modal -->
<div class="modal fade" id="createClass" tabindex="-1" role="dialog" aria-labelledby="createClassLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createClassLabel">create Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showCreateModal(1)">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <h3>Intitule</h3>
    <input type="text" required v-model="int" />
    <h3>Abreavtion</h3>
    <input type="text" required v-model="ab" />
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
  name: "CreateClassModal",
  props: {
  },
  data(){
      return {
          int:"",
          ab:"",
      };
  },
  methods: {
      postData(){
        this.$emit('post-data',{
            intitule:this.int,
            abbreviation:this.ab
        })
      },
      showCreateModal(del){
          if (del){
              this.int=this.ab="";
          }
          this.$emit('show-create-modal',{del})
      }
  }
};
</script>

