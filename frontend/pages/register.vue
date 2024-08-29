<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Register new account</h1>
    </v-col>

    <v-row>
      <v-col cols="12" md="12">
        <UserForm :form="form"></UserForm>
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
    form: {
      id: 0,
      confirm_password: "",
      password: "",
      email: "",
      name: "",
    },
  }),
  watch: {},
  async mounted() {},
  async created() {},
  methods: {
    async createPost() {
      this.response = await $fetch("http://127.0.0.1:8000/api/create-user", {
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
