<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Blog</h1>
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
    const token = useCookie("token");
    if (token) {
      this.data = await $fetch("http://127.0.0.1:8000/api/posts", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " +token.value,
          Accept: "application/json",
        },
      });
      if (this.data.success) {
        this.data = this.data.data;
      }
    }
  },
  methods: {
    
  },
};
</script>



<style>

</style>
