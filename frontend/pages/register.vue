<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Register</h1>
    </v-col>

  </v-row>
</template>


<script>
definePageMeta({
  layout: "web-layout",
});
export default {
  components: {},
  data: () => ({
    // post: "",
  }),
  watch: {},
  async mounted() {},
  async created() {
    // this.post = await $fetch("http://127.0.0.1:8000/api/posts/1", {
    //   method: "GET",
    //   headers: {
    //     "Content-Type": "application/json",
    //   },
    // });
    // if (this.post.success) {
    //   if (this.post.data) {
    //     this.post = this.post.data;
    //   }
    // }
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
