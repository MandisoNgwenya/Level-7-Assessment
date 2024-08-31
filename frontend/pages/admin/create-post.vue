<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1 v-if="form.id === 0" class="text-uppercase">Create new blog post</h1>
      <h1 v-else class="text-uppercase">Edit blog post</h1>
    </v-col>

    <v-row>
      <v-col cols="12" md="12">
        <v-card>
          <v-col cols="12" md="12">
            <v-text-field :label="'Title'" v-model="form.title"></v-text-field>
          </v-col>
          <v-col cols="12" md="12">
            <v-text-field
              type="date"
              :label="'Publish date'"
              v-model="form.publish_date"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="12">
            <v-file-input
              type="file"
              @change="getFileObject($event)"
              label="Thumbnail"
              prepend-icon="mdi-camera"
              variant="filled"
              multiple="false"
              id="myfile"
            ></v-file-input>
          </v-col>
          <v-col cols="12" md="12">
            <v-textarea
              :label="'Description'"
              v-model="form.description"
            ></v-textarea>
          </v-col>
          <v-col cols="12" md="12">
            <v-textarea
              :label="'Tags Seperate by Comma (,)'"
              v-model="form.keywords"
            ></v-textarea>
          </v-col>
          <v-col cols="12" md="12" id="excerpt">
            <label>Excerpt (Max characters 150) </label>

            <editor v-model="form.excerpt" />

            <!-- <TiptapEditor v-model="content"> </TiptapEditor> -->
          </v-col>
          <v-col cols="12" md="12">
            <label>Body</label>
            <editor v-model="form.body" />
            <!-- <TiptapEditor v-model="form.body"> </TiptapEditor> -->
          </v-col>
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
              <v-btn width="100%" @click="createPost()"> Publish</v-btn>
            </div>
          </v-col>
        </v-card>
      </v-col>
    </v-row>
  </v-row>
</template>


<script>
definePageMeta({
  layout: "web-layout",
  middleware: "auth",
});

export default {
  components: {},
  data: () => ({
    post_id: 0,
    form: {
      id: 0,
      publish_date: "",
      body: "",
      title: "",
      published: false,
      excerpt: "",
      description: "",
      thumbnail: "",
      tags: "",
    },
  }),
  watch: {},
  async mounted() {},
  async created() {
    const route = useRoute();
    if(route.query.id){
       this.post_id = route.query.id;
    }
   
    const token = useCookie("token");
    if (token) {
      this.post = await $fetch(
        "http://127.0.0.1:8000/api/posts/" + this.post_id,
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + token.value,
            Accept: "application/json",
          },
        }
      );

      if (this.post.success) {
        if (this.post.data) {
          this.form = this.post.data;
        }
      }
    }
  },
  methods: {
    async getFileObject(event) {
      this.form.thumbnail = event.target.files;
    },

    async createPost() {
      const token = useCookie("token");
      const fileInput = document.querySelector("#myfile");
      const formData = new FormData();

      formData.append("file", fileInput.files[0]);
      formData.append("form", JSON.stringify(this.form));

      const options = {
        method: "POST",
        body: formData,
        headers: {
          Authorization: "Bearer " + token.value,
          Accept: "application/json",
        },
      };

      // fetch("http://127.0.0.1:8000/api/create-post", options);

      // return;

      this.response = await $fetch(
        "http://127.0.0.1:8000/api/create-post",
        options
      );
      if (this.response.success) {
        const router = useRouter();
        router.push({ path: "/admin/posts" });
      }
    },
  },
};
</script>



<style>
</style>
