<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1 v-if="form.id === 0">Create new blog post</h1>
      <h1 v-else>Edit blog post</h1>
    </v-col>

    <v-row >
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
              label="Thumbnail"
              prepend-icon="mdi-camera"
              variant="filled"
              v-model="form.thumbnail"
              multiple="true"
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
              v-model="form.tags"
            ></v-textarea>
          </v-col>
          <v-col cols="12" md="12" id="excerpt">
            <label>Excerpt (Max characters 150) </label>
      
            <TiptapEditor v-model="form.excerpt"> </TiptapEditor>
          </v-col>
          <v-col cols="12" md="12">
            <label>Body</label>
            <TiptapEditor v-model="form.body"> </TiptapEditor>
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
});
export default {
  components: {
    // QuillEditor
  },
  data: () => ({
    form: {
      id: 0,
      publish_date: "",
      body: '<p><span style="background-color: rgb(245, 245, 245); color: rgba(0, 0, 0, 0.87);">With many years of experience in providing clients with relevant, useful and reliable promotional items and advice, GiftWrap has become South Africa’s biggest and most innovative promotional gift wholesaler, importer and manufacturer. We sell branded gifts online, making it easier than ever before to stock up on those premium corporate personalized gifts that are guaranteed to get people talking. And that is exactly what you want promotional products to do. Promotional items have a long history in the marketing profession and they remain as popular as ever. GiftWrap stocks the biggest selection of promotional items and we offer an additional service of adding personalized branding (including logos and details embroidered on products).</span></p>',
      title: "",
      published: false,
      excerpt: '<p>Quis quaerat adipisi.</p>',
      description:'',
      thumbnail:'',
      tags:''
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
    async createPost() {
      this.response = await $fetch("http://127.0.0.1:8000/api/create-post", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: { form: this.form },
      });
    },
  },
};
</script>



<style>
</style>
