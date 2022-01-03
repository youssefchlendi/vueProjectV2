<template>
  <navBar />
  <div class="eteudient">
    <button type="button" class="btn btn-success float-end mx-4" @click="showCreateModal">
      Add
    </button>
    <h1>Gestion des matiere</h1>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Intitule</th>
          <th scope="col">Coefficient</th>
          <th scope="col">IdProf</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="matiere in matieres" :key="matiere.id">
          <td>{{ matiere.id }}</td>
          <td>{{ matiere.intitule }}</td>
          <td>{{ matiere.coefficient }}</td>
          <td>{{ matiere.idProf }}</td>
          <td>
            <button
              type="button"
              class="btn btn-danger"
              @click="deleteData(matiere.id)"
            >
              <span class="material-icons">delete</span>
            </button>
            <button
              type="button"
              class="mx-2 btn btn-warning"
              @click="showEditModal(matiere.id)"
            >
              <span class="material-icons">edit</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <UpdateMatiereModal
      @show-edit-modal="showEditModal"
      @update-data="updateData"
      :Pid="Number(id)"
    />
    <CreateMatiereModal
      @show-create-modal="showCreateModal"
      @post-data="postData"
    />
  </div>
</template>

<script>
import UpdateMatiereModal from "../components/matiere/UpdateMatiereModal.vue";
import CreateMatiereModal from "../components/matiere/CreateMatiereModal.vue";
// @ is an alias to /src
import axios from "axios";
import navBar from "../components/navbar.vue";
export default {
  name: "Matiere",
  components: {
    CreateMatiereModal,
    UpdateMatiereModal,
    navBar,
  },
  data() {
    return {
      id: 0,
      matieres: null,
      matiere: null,
    };
  },
  methods: {
    getAll() {
      axios
        .get("http://localhost:8085/api/matiere/read.php")
        .then((response) => (this.matieres = response.data))
        .then(() => {
          const tab = [];
          Object.keys(this.matieres).forEach((key) =>
            this.matieres[key].forEach((key) => tab.push(key))
          );
          this.matieres = tab;
        });
    },
    postData(arg) {
      let data;
      if (typeof arg !== "undefined") {
        data = arg;
      }
      axios
        .post("http://localhost:8085/api/matiere/create.php", data)
        .then((res) => {
          console.log(res);
        })
        .then(() => {
          this.getAll();
          this.showCreateModal(1);
        });
    },
    showCreateModal() {
      window.$("#createMatiere").hasClass("show")
        ? window.$("#createMatiere").modal("hide")
        : window.$("#createMatiere").modal("show");
    },
    deleteData(id) {
      let data = {
        id: id,
      };
      let header = {};
      axios
        .post("http://localhost:8085/api/matiere/delete.php", data, header)
        .then((res) => {
          console.log(res);
        })
        .then(() => {
          this.getAll();
        });
    },
    showEditModal(id) {
      this.id = id;
      window.$("#editMatiere").hasClass("show")
        ? window.$("#editMatiere").modal("hide")
        : window.$("#editMatiere").modal("show");
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
        .post("http://localhost:8085/api/matiere/update.php", data, header)
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
