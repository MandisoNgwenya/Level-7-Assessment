<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Administrator</h1>
    </v-col>

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
    // post: "",
  }),
  watch: {},
  async mounted() {},
  async created() {

  },
  methods: {

  },
};
</script>



<style>

</style>
