<template>
  <v-sheet class="bg-blue pa-12" squared>
    <v-col cols="12" md="12">
      <h1 class="text-uppercase">Register a new account</h1>
    </v-col>
    <v-card class="mx-auto px-6 py-8" max-width="100%">
      <UserForm :form="form" :parentPage="'Register'"></UserForm>
    </v-card>
  </v-sheet>
  <v-row>
    <v-row>
      <v-col cols="12" md="12" class="justify-content-center"> </v-col>
    </v-row>
  </v-row>
</template>


<script>
definePageMeta({
  layout: "web-layout",
});
export default {
  components: {},
  data: () => ({}),
  watch: {},
  async mounted() {},
  async created() {},
  methods: {},
};
</script>



<style>
</style>
