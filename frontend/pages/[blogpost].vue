<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Level 7 Assessment</h1>
    </v-col>
    <v-col cols="12" md="6">
      <v-img
        height="500px"
        width="100%"
        eager
        position="center center"
        :src="'http://127.0.0.1:8000/no-image.jpg'"
        :href="post.url"
      >
      </v-img>
    </v-col>
    <v-col cols="12" md="6">
      <v-card-title>{{ post.title }}</v-card-title>
      <v-card-text> <div v-html="post.excerpt"></div> </v-card-text>

      <v-divider class="mt-3"></v-divider>
      <v-card-text> <div v-html="post.body"></div> </v-card-text>

      <v-col cols="12" md="12">
        <v-textarea :label="'Comment'" v-model="form.comment"></v-textarea>
        <div class="float-end">
          <v-btn class="m-2" @click="sendComment"> Send Comment </v-btn>
          <!-- <v-btn icon="mdi-comment" variant="text"></v-btn> -->
        </div>
      </v-col>
    </v-col>
    <!-- </template> -->
  </v-row>
</template>


<script>
definePageMeta({
  layout: "web-layout",
});
export default {
  components: {},
  data: () => ({
    post: "",
    form: {
      comment: "",
      post_id: 0,
      user_id: 0,
    },
  }),
  watch: {},
  async mounted() {},
  async created() {
    this.post = await $fetch("http://127.0.0.1:8000/api/posts/1", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (this.post.success) {
      if (this.post.data) {
        this.post = this.post.data;
      }
    }
  },
  methods: {
    async sendComment() {
      this.form.post_id = this.post.id;
      this.form.user_id = 1;
      this.response = await $fetch("http://127.0.0.1:8000/api/create-comment", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: { form: this.form },
      });
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
