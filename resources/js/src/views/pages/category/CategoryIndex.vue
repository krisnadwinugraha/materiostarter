<template>
  <v-card flat class="my-5 mx-5">
    <div class="d-flex align-center mx-6 my-5">
      <v-spacer></v-spacer>
      <v-text-field
        rounded
        dense
        outlined
        :prepend-inner-icon="icons.mdiMagnify"
        class="app-bar-search flex-grow-0"
        hide-details
        type="'text'"
        v-model="keywords"
      ></v-text-field>
    </div>
    <v-simple-table>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-uppercase">Name</th>
            <th class="text-uppercase">Deskripsi</th>
            <th class="text-uppercase">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.name">
            <td>{{ category.name }}</td>
            <td>
              {{ category.deskripsi }}
            </td>
            <td>
              <router-link :to="{ name: 'category-edit', params: { id: category.id } }" class="btn btn-success"
                ><v-btn color="primary" class="me-3"> Edit </v-btn></router-link
              >
              <v-btn color="danger" outlined @click="deleteCategory(category.id)" class="btn btn-danger">Delete</v-btn>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <div class="d-flex align-center mx-6 my-5">
      <v-spacer></v-spacer>
      <v-btn color="primary" :disabled="currentPage === 1" @click="changePage(-1)">Prev</v-btn>
      <v-btn color="primary" :disabled="currentPage === lastPage" @click="changePage(1)">Next >></v-btn>
    </div>
  </v-card>
</template>

<script>
import { mdiAlertOutline, mdiMagnify, mdiCloudUploadOutline } from '@mdi/js'
import { ref } from '@vue/composition-api'
import axios from 'axios'

export default {
  name: 'categories',
  data() {
    return {
      categories: [],
      keywords: null,
      lastPage: '',
      currentPage: 1,
    }
  },
  watch: {
    keywords(after, before) {
      this.fetch()
    },
  },
  mounted() {
    this.getCategories()
  },
  methods: {
    async getCategories() {
      await axios
        .get(`/api/categories?page=${this.currentPage}`)
        .then(response => {
          this.categories = response.data.data
          this.lastPage = response.data.last_page
        })
        .catch(error => {
          console.log(error)
          this.categories = []
        })
    },
    deleteCategory(id) {
      if (confirm('Are you sure to delete this category ?')) {
        axios
          .delete(`/api/categories/${id}`)
          .then(response => {
            this.getCategories()
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
    fetch() {
      axios
        .get('/category-search', { params: { keywords: this.keywords } })
        .then(response => (this.categories = response.data.data))
        .catch(error => {})
    },
    changePage(num) {
      this.currentPage = this.currentPage + num
      this.getCategories()
    },
  },
  setup() {
    return {
      icons: {
        mdiAlertOutline,
        mdiCloudUploadOutline,
        mdiMagnify,
      },
    }
  },
}
</script>
