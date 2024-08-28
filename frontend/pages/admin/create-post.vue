<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1 v-if="form.id === 0">Create new blog post</h1>
      <h1 v-else>Edit blog post</h1>
    </v-col>

 
      <v-row >
        <v-col cols="12" md="6">
          <v-card class="p-5 m-5">
            <v-col cols="12" md="12">
              <div >
                <v-btn
                  role="button"
                  width="100%"
                  @click.prevent="visitArticle(form.title, form.id)"
                  >View Article
                </v-btn>
              </div>
            </v-col>
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field
                  :label="'Title'"
                  v-model="form.title"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  :label="'Author ( search by email) '"
                  v-model="form.author"
                  v-on:keyup="searchAuthor()"
                ></v-text-field>

                <v-card v-if="resultsView" class="p-5">
                  <a
                    class="float-end"
                    style="cursor: pointer"
                    @click="resultsView = !resultsView"
                    >X</a
                  >
                  Select Author

                  <v-row>
                    <a
                      v-if="authorsData"
                      v-for="(author, index) in authorsData.items"
                      class="col-md-6 mb-2 mt-1"
                      style="cursor: pointer"
                      @click="assignAuthor(author)"
                    >
                      {{ author.first_name }} {{ author.last_name }} -
                      {{ author.email }}

                      <!-- <span> <i class="fa fa-check"></i></span> -->
                    </a>
                  </v-row>

                  <a
                    v-if="authorsData.more_items"
                    class="mt-8 mb-5 float-end"
                    style="cursor: pointer"
                    @click="searchAuthor(true)"
                    >Load more results >>></a
                  >
                </v-card>
              </v-col>
              <v-col cols="12" md="6">
                <v-textarea
                  :label="'Keywords'"
                  v-model="form.keywords"
                ></v-textarea>
              </v-col>
              <v-col cols="12" md="6">
                <v-textarea
                  :label="'Description'"
                  v-model="form.description"
                ></v-textarea>
              </v-col>
              <v-col cols="12" md="6">
                <v-textarea
                  :label="'Tags Seperate by Comma (,)'"
                  v-model="form.tags"
                ></v-textarea>
              </v-col>
              <v-col cols="12" md="12">
             
     <v-file-input
    label="Thumbnail"
    prepend-icon="mdi-camera"
    variant="filled"
  ></v-file-input>
              </v-col>
              <v-col cols="12" md="12">
                <div class="row">
                  <div
                    v-if="images"
                    class="col-md-3"
                    v-for="(image, index) in images"
                  >
                    <v-card class="p-3 mt-5 v-card-custom-white image-div">
                      <div class="row">
                        <v-img
                          :src="
                            '/posts/images/' + image.filename + '.' + image.ext
                          "
                          width=""
                          height="200"
                          class="cat-image"
                        ></v-img>

                     
                       
                      </div>
                    </v-card>
                  </div>
                </div>
              </v-col>
              <v-col cols="12" md="12" id="excerpt">
                <div style="margin-top: 25px">
                  <label>Excerpt (Max characters 150) </label>
                  <TiptapEditor> </TiptapEditor>
                </div>
              </v-col>
              <v-col cols="12" md="12">
                <div style="margin-top: 25px">
                  <label>Body</label>
                  <TiptapEditor> </TiptapEditor>
                  <v-col cols="12 mt-5" md="12">
                    <label> Published </label>
                    <input
                      type="checkbox"
                      class="ml-2 mb-2"
                      v-model="form.published"
                      :checked="form.published === 1"
                    />
                  </v-col>

                  <v-col cols="12" md="12">
                    <div class="mt-1 mb-5">
                      <v-btn width="100%" @click="createArticle()">
                        Publish</v-btn
                      >
                    </div>
                  </v-col>
                </div>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>

  </v-row>
</template>


<script>
// import Editor from '/components/Editor.vue';
// import { QuillEditor } from '@vueup/vue-quill'
// import '@vueup/vue-quill/dist/vue-quill.snow.css';

definePageMeta({
  layout: "web-layout",
});
export default {
  components: {
    // QuillEditor
  },
  data: () => ({
    form: {
      id: 0,
      author_id: 0,
      author: {
        first_name: "",
        last_name: "",
        email: "",
      },
      body: "",
      title: "",
      domain_categories: [],
      published: false,
      loadMore: false,
      excerpt: "",
      images: {
        main_image: false,
        thumbnail_image: false,
        excerpt_image: false,
      },
    },
  }),
  watch: {
    group() {
      this.drawer = false;
    },
  },
  async mounted() {},
  async created() {
    this.posts = await $fetch("http://127.0.0.1:8000/api/posts", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
  },
  methods: {
    assignAuthor(author) {
      this.form.author = author.first_name + author.last_name;
      this.form.author_id = author.id;
      this.resultsView = false;
    },
    searchAuthor(loadMore = false) {
      this.payload.searchTerm = this.form.author;
      this.payload.action = "search-authors";
      if (this.payload.searchTerm !== "") {
        let url = "/search";
        if (loadMore) {
          url = url + "?page=" + (this.authorsData.current_page + 1);
        }
        axios
          .post(url, this.payload)
          .then((res) => {
            this.resultsView = true;
            this.authorsData = res.data;
          })
          .catch((err) => {});
      } else {
        this.resultsView = false;
        this.authorsData = false;
      }
    },
    savePost() {
      this.payload.searchTerm = this.form.author;
      this.payload.action = "search-authors";
      this.payload.form;
      axios
        .post("action", this.payload)
        .then((res) => {
          this.resultsView = true;
          this.authorsData = res.data;
        })
        .catch((err) => {});
    },
    async getA() {
      this.response = await $fetch("http://127.0.0.1:8000/api/posts", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: {
          email: "mandiso0sd42@yahoo.com",
          password: "password",
          name: "Mandiso Ngwenya",
          c_password: "password",
        },
      });
    },
  },
};
</script>



<style>
</style>
