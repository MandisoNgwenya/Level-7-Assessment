<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1 class="text-uppercase">Register a new account</h1>
    </v-col>

    <v-row>
      <v-col cols="12" md="12" class="justify-content-center">
        <UserForm :form="form" :parentPage="'Register'"></UserForm>
      </v-col>
    </v-row>
  </v-row>
</template>


<script>
definePageMeta({
  layout: "web-layout",
});
export default {
  components: {},
  data: () => ({
  
  }),
  watch: {},
  async mounted() {},
  async created() {},
  methods: {
  },
};
</script>



<style>
</style>
