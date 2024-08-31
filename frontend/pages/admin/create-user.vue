<template>
  <v-sheet class="bg-blue pa-12" squared>
    <v-col cols="12" md="12">
      <h1 class="text-uppercase">Create new user</h1>
    </v-col>
    <v-card class="mx-auto px-6 py-8" max-width="100%">
      <UserForm :form="form" :parentPage="'Create User'"></UserForm>
    </v-card>
  </v-sheet>
</template>


<script>
definePageMeta({
  layout: "web-layout",
  middleware: "auth",
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
