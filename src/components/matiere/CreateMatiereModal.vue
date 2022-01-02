<template>
  <div class="createMatiere">
    <!-- Create Modal -->
    <div
      class="modal fade"
      id="createMatiere"
      tabindex="-1"
      role="dialog"
      aria-labelledby="createMatiereLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createMatiereLabel">create Matiere</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="showCreateModal(1)"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h3>Intitule</h3>
            <input type="text" required v-model="intitule" />
            <h3>Coefficient</h3>
            <input type="number" required v-model="coefficient" />
            <h3>IdProf</h3>
            <select v-model="idProf">
              <option v-for="prof in profs" :key="prof.id" :value="prof.id">
                {{ prof.nom + " " + prof.prenom }}
              </option>
            </select>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="showCreateModal(1)"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="postData">
              Save changes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "CreateMatiereModal",
  props: {},
  data() {
    return {
      id: "",
      intitule: "",
      coefficient: "",
      idProf: "",
      profs: null,
    };
  },
  methods: {
    postData() {
      this.$emit("post-data", {
        intitule: this.intitule,
        coefficient: parseFloat(this.coefficient),
        idProf: this.idProf,
      });
      this.id = "";
      this.intitule = "";
      this.coefficient = "";
      this.idProf = "";
    },
    showCreateModal(del) {
      if (del) {
        this.id = "";
        this.intitule = "";
        this.coefficient = "";
        this.idProf = "";
      }
      this.$emit("show-create-modal", { del });
    },
    getAllProfs() {
      axios
        .get("http://localhost:8085/api/enseignant/read.php")
        .then((response) => (this.profs = response.data))
        .then(() => {
          const tab = [];
          Object.keys(this.profs).forEach((key) =>
            this.profs[key].forEach((key) => tab.push(key))
          );
          this.profs = tab;
        });
    },
  },
  mounted() {
    let i = true;
    if (i) this.getAllProfs();
    i = false;
  },
};
</script>
