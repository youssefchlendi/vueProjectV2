<template>
  <navBar />
  <div class="eteudient m-4" style="margin-bottom:250px!important">
    <button type="button" class="btn btn-success float-end mx-4" @click="showCreateModal">
      Add
    </button>
    <h1>Gestion des examens</h1>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">IdMatiere</th>
          <th scope="col">IdProf</th>
          <th scope="col">Intitule</th>
          <th scope="col">Coefficient</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="examen in examens" :key="examen.id">
          <td>{{ examen.id }}</td>
          <td>{{ examen.idMatiere }}</td>
          <td>{{ examen.idProf }}</td>
          <td>{{ examen.intitule }}</td>
          <td>{{ examen.coefficient }}</td>
          <td>
            <button
              type="button"
              class="btn btn-danger"
              @click="deleteData(examen.id)"
            >
              <span class="material-icons">delete</span>
            </button>
            <button
              type="button"
              class="mx-2 btn btn-warning"
              @click="showEditModal(examen.id)"
            >
              <span class="material-icons">edit</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <UpdateExamenModal
      @show-edit-modal="showEditModal"
      @update-data="updateData"
      :Pid="Number(id)"
    />
    <CreateExamenModal
      @show-create-modal="showCreateModal"
      @post-data="postData"
    />
  </div>
</template>

<script>
import UpdateExamenModal from "../components/examen/UpdateExamenModal.vue";
import navBar from "../components/navbar.vue";
import CreateExamenModal from "../components/examen/CreateExamenModal.vue";
// @ is an alias to /src
import axios from "axios";
export default {
  name: "Examen",
  components: {
    CreateExamenModal,
    UpdateExamenModal,
    navBar,
  },
  data() {
    return {
      id: null,
      examens: null,
      examen: null,
    };
  },
  methods: {
    getAll() {
      axios
        .get("http://localhost:8085/api/examen/read.php")
        .then((response) => (this.examens = response.data))
        .then(() => {
          const tab = [];
          Object.keys(this.examens).forEach((key) =>
            this.examens[key].forEach((key) => tab.push(key))
          );
          this.examens = tab;
        });
    },
    postData(arg) {
      let data;
      if (typeof arg !== "undefined") {
        data = arg;
      }
      axios
        .post("http://localhost:8085/api/examen/create.php", data)
        .then((res) => {
          console.log(res);
        })
        .then(() => {
          this.getAll();
          this.showCreateModal(1);
        });
    },
    showCreateModal() {
      window.$("#CreateExamen").hasClass("show")
        ? window.$("#CreateExamen").modal("hide")
        : window.$("#CreateExamen").modal("show");
    },
    deleteData(id) {
      let data = {
        id: id,
      };
      let header = {};
      axios
        .post("http://localhost:8085/api/examen/delete.php", data, header)
        .then((res) => {
          console.log(res);
        })
        .then(() => {
          this.getAll();
        });
    },
    showEditModal(id) {
      this.id = id;
      window.$("#editExamen").hasClass("show")
        ? window.$("#editExamen").modal("hide")
        : window.$("#editExamen").modal("show");
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
        .post("http://localhost:8085/api/examen/update.php", data, header)
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
