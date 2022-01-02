<template>
  <navBar />
  <div class="eteudient">
    <button type="button" class="btn btn-success" @click="showCreateModal">
      Add
    </button>
    <h1>Gestion des enseignant</h1>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">CIN</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="enseignant in enseignants" :key="enseignant.id">
          <td>{{ enseignant.id }}</td>
          <td>{{ enseignant.nom }}</td>
          <td>{{ enseignant.prenom }}</td>
          <td>{{ enseignant.cin }}</td>
          <td>
            <button
              type="button"
              class="btn btn-danger"
              @click="deleteData(enseignant.id)"
            >
              <span class="material-icons">delete</span>
            </button>
            <button
              type="button"
              class="mx-2 btn btn-warning"
              @click="showEditModal(enseignant.id)"
            >
              <span class="material-icons">edit</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <UpdateEnseignantModal
      @show-edit-modal="showEditModal"
      @update-data="updateData"
      :Pid="id"
    />
    <CreateEnseignantModal
      @show-create-modal="showCreateModal"
      @post-data="postData"
    />
  </div>
</template>

<script>
import navBar from "../components/navbar.vue";
import UpdateEnseignantModal from "../components/enseignant/UpdateEnseignantModal.vue";
import CreateEnseignantModal from "../components/enseignant/CreateEnseignantModal.vue";
// @ is an alias to /src
import axios from "axios";
export default {
  name: "Enseignant",
  components: {
    CreateEnseignantModal,
    UpdateEnseignantModal,
    navBar,
  },
  data() {
    return {
      id: null,
      enseignants: null,
      enseignant: null,
    };
  },
  methods: {
    getAll() {
      axios
        .get("http://localhost:8085/api/enseignant/read.php")
        .then((response) => (this.enseignants = response.data))
        .then(() => {
          const tab = [];
          Object.keys(this.enseignants).forEach((key) =>
            this.enseignants[key].forEach((key) => tab.push(key))
          );
          this.enseignants = tab;
        });
    },
    postData(arg) {
      let data;
      if (typeof arg !== "undefined") {
        data = arg;
      }
      axios
        .post("http://localhost:8085/api/enseignant/create.php", data)
        .then((res) => {
          console.log(res);
        })
        .then(() => {
          this.getAll();
          this.showCreateModal(1);
        });
    },
    showCreateModal() {
      window.$("#createEnseignant").hasClass("show")
        ? window.$("#createEnseignant").modal("hide")
        : window.$("#createEnseignant").modal("show");
    },
    deleteData(id) {
      let data = {
        id: id,
      };
      let header = {};
      axios
        .post("http://localhost:8085/api/enseignant/delete.php", data, header)
        .then((res) => {
          console.log(res);
        })
        .then(() => {
          this.getAll();
        });
    },
    showEditModal(id) {
      this.id = id;
      window.$("#editEnseignant").hasClass("show")
        ? window.$("#editEnseignant").modal("hide")
        : window.$("#editEnseignant").modal("show");
    },
    updateData(arg) {
      let data;
      if (typeof arg !== "undefined") {
        data = arg;
      }
      console.log(arg);
      let header = {
        "Access-Control-Allow-Origin": "*",
        Accept: "*/*",
        Connection: "keep-alive",
        "Content-type": "application/json",
      };
      axios
        .post("http://localhost:8085/api/enseignant/update.php", data, header)
        .then((res) => {
          console.log(res);
        })
        .then(() => {
          this.getAll();
          this.showEditModal(0);
        });
    },
  },
  mounted() {
    this.getAll();
  },
};
</script>
