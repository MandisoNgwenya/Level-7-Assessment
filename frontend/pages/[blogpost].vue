<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Level 7 Assessment</h1>
    </v-col>
    <v-col cols="12" md="6">
      <v-card class="mx-auto">
        <div class="hover-wrapper">
          <v-img
            height="250"
            eager
            position="center center"
            :src="post.thumbnail"
            :href="post.url"
          >
          </v-img>
        </div>
      </v-card>
    </v-col>
    <v-col cols="12" md="6">
      <v-card-title>{{ post.title }}</v-card-title>
      <v-card-text>{{ post.excerpt }}</v-card-text>

      <v-divider class="mt-3"></v-divider>
      <v-card-text>
        <div class="d-flex align-center">
          <!-- <v-col sm="3">
                <v-img
                  height="60"
                  width="60"
                  aspect-ratio
                  class="rounded-circle"
                  :src="post.authorImage"
                >
                </v-img>
              </v-col> -->
          <v-col sm="12">
            <p class="mb-0 subtitle-1">{{ post.body }}</p>
          </v-col>
        </div>
      </v-card-text>
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
