<template>
  <v-row>
    <v-col cols="12" md="12">
      <v-sheet class="bg-blue pa-12" squared>
            <v-col cols="12" md="12">
      <h1 class="text-uppercase">Login</h1>
    </v-col>
   
        <v-card class="mx-auto px-6 py-8" max-width="500">
          <v-col v-if="this.errorBag" cols="12" md="12">
            <v-alert class="bg-orange"
              ><strong class="text-uppercase">
                Sorry we do not recognise that user</strong
              ></v-alert
            >
          </v-col>
          <v-col cols="12" md="12">
            <v-text-field
              :label="'Email'"
              type="email"
              v-model="form.email"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="12">
            <v-text-field
              :label="'Password'"
              type="password"
              v-model="form.password"
            ></v-text-field>
          </v-col>

          <v-col cols="12" md="12">
            <div class="mt-1 mb-5">
              <v-btn width="100%" @click="login()"> Login </v-btn>
            </div>
          </v-col>
        </v-card>
        <v-col cols="12" md="12">
          <div class="text-center">
            <small>
              Do not have an account?
              <NuxtLink type="button" :href="'/register'"> register </NuxtLink>
            </small>
          </div>
        </v-col>
      </v-sheet>
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
    errorBag: false,
    form: {
      password: "",
      email: "",
    },
  }),
  watch: {},
  async mounted() {
            this.errorBag = false;
  },
  async created() {},
  methods: {
    async login() {
      this.response = await $fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: { form: this.form },
      });
      if (this.response.success) {
        this.errorBag = false;
        let _user = await $fetch("api/user", {
          method: "POST",
          body: {
            cookie: this.response.data.name,
          },
        });

        let _token = await $fetch("api/token", {
          method: "POST",
          body: {
            cookie: this.response.data.token,
          },
        });
        const router = useRouter();
        router.push({ path: "admin/posts" });
      } else {
        this.errorBag = true;
      }
      console.log(this.response, "login response");
    },
  },
};
</script>



<style>
</style>
