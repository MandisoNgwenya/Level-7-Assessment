
<template>
  <div id="web-layout">
    <v-app>
      <v-layout>
        <v-app-bar color="primary" prominent>
          <v-app-bar-nav-icon
            variant="text"
            @click.stop="drawer = !drawer"
          ></v-app-bar-nav-icon>

          <v-toolbar-title>Level 7 Assessment</v-toolbar-title>

          <v-spacer></v-spacer>

          <template v-if="$vuetify.display.mdAndUp">
            <v-btn icon="mdi-magnify" variant="text"></v-btn>

            <v-btn icon="mdi-account" variant="text"></v-btn>
          </template> 
        </v-app-bar>

        <v-navigation-drawer
          v-model="drawer"
          :location="$vuetify.display.mobile ? 'bottom' : undefined"
          temporary
        >
          <v-btn
            v-for="(item, i) in items"
            class="mt-2"
            width="100%"
         @click="visitPage('/'+item.name)"
          >
            <!-- <i class="mdi-account"></i> -->
         {{ item.text }}
          </v-btn>
          <!-- <v-list :items="items" @click="visitPage()"></v-list> -->
        </v-navigation-drawer>

        <v-main>
          <v-container width="60%">
            <slot />
          </v-container>
        </v-main>
      </v-layout>
    </v-app>
  </div>
</template>


<script>
definePageMeta({
  layout: "custom",
});
export default {
  components: {},
  data: () => ({
    response: false,
    drawer: false,
    group: null,
    users: "",
    items: [
      { text: "Home", icon: "mdi-widgets", name: "" },
      { text: "Register", icon: "mdi-widgets", name: "register" },
      { text: "Login", icon: "mdi-widgets", name: "login" },
      { text: "Posts", icon: "mdi-account-multiple", name: "admin/posts" },
      { text: "Users", icon: "mdi-account-multiple", name: "admin/users" },
      { text: "Forgot Password", icon: "mdi-widgets", name: "forgot-password" },
       { text: "Comments", icon: "mdi-widgets", name: "admin/comments" },
    ],
  }),
  watch: {
    group() {
      this.drawer = false;
    },
  },
  async mounted() {},
  async created() {},
  methods: {

    visitPage(page) {
           const router = useRouter();
      router.push({ path: page });
    },
    async getA() {
      this.response = await $fetch("http://127.0.0.1:8000/api/register", {
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

      return this.response;
    },
  },
};
</script>



<style>
.hover-wrapper {
  display: block !important;
  position: relative !important;
  overflow: hidden !important;
}

.hover-wrapper .v-image {
  -webkit-transition: all 0.5s ease-in-out !important;
  -moz-transition: all 0.5s ease-in-out !important;
  -o-transition: all 0.5s ease-in-out !important;
  -ms-transition: all 0.5s ease-in-out !important;
  transition: all 0.5s ease-in-out !important;
}

.hover-wrapper:hover .v-image {
  -webkit-transform: scale(1.1) !important;
  -moz-transform: scale(1.1) !important;
  -o-transform: scale(1.1) !important;
  -ms-transform: scale(1.1) !important;
  transform: scale(1.1);
}
</style>
