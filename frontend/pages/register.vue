<template>
      <Head>
      <Title>{{ "Register - Level 7 Assessment" }}</Title>
      <Meta name="description" :content="'Level 7 Assessment Description'" />
    </Head>
  <v-sheet class="bg-blue pa-12" squared>
    <v-col cols="12" md="12">
      <h1 class="text-uppercase">Register a new account</h1>
    </v-col>
    <v-card class="mx-auto px-6 py-8" max-width="100%">
      <UserForm :form="form" :parentPage="'Register'"></UserForm>
    </v-card>
    <v-col cols="12" md="12">
      <div class="text-center">
        <small>
          Already have and account?
          <NuxtLink type="button" :href="'/login'">
            Login
          </NuxtLink>
        </small>
      </div>
    </v-col>
  </v-sheet>

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
