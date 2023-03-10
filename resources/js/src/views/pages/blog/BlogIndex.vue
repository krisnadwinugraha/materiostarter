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
            <th class="text-uppercase">Title</th>
            <th class="text-uppercase">Category</th>
            <th class="text-uppercase">Content</th>
            <th class="text-uppercase">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="blog in blogs" :key="blog.title">
            <td>{{ blog.title }}</td>
            <td>
              {{ blog.category_id.name }}
            </td>
            <td width="50%">
              {{ blog.content }}
            </td>
            <td>
              <router-link :to="{ name: 'blog-edit', params: { id: blog.id } }" class="btn btn-success"
                ><v-btn color="primary" class="me-3"> Edit </v-btn></router-link
              >
              <v-btn color="danger" outlined @click="deleteBlog(blog.id)" class="btn btn-danger">Delete</v-btn>
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
  name: 'blogs',
  data() {
    return {
      blogs: [],
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
    this.getBlogs()
  },
  methods: {
    async getBlogs() {
      await axios
        .get(`/api/blogs?page=${this.currentPage}`)
        .then(response => {
          this.blogs = response.data.data
          this.lastPage = response.data.last_page
        })
        .catch(error => {
          console.log(error)
          this.blogs = []
        })
    },
    deleteBlog(id) {
      if (confirm('Are you sure to delete this blog ?')) {
        axios
          .delete(`/api/blogs/${id}`)
          .then(response => {
            this.getBlogs()
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
    fetch() {
      axios
        .get('/blog-search', { params: { keywords: this.keywords } })
        .then(response => (this.blogs = response.data.data))
        .catch(error => {})
    },
    changePage(num) {
      this.currentPage = this.currentPage + num
      this.getBlogs()
    },
  },
  setup() {
    return {
      icons: {
        mdiAlertOutline,
        mdiMagnify,
        mdiCloudUploadOutline,
      },
    }
  },
}
</script>
