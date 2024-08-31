
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
    
          <div v-for="(item, i) in items">
            <v-btn
              v-if="_token && item.admin"
              class="mt-3"
              width="100%"
              @click="visitPage('/' + item.name)"
            >
              <span> {{ item.text }} </span>
            </v-btn>

            <v-btn
              v-if="item.admin == false"
              class="mt-3"
              width="100%"
              @click="visitPage('/' + item.name)"
            >
              <span> {{ item.text }} </span>
            </v-btn>
          </div>
        </v-navigation-drawer>

        <v-main >
          <v-container width="60%" class="mt-16" >
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
    _token: false,
    drawer: false,
    group: null,
    users: "",
    items: [
      { text: "Blog", icon: "mdi-widgets", name: "", admin: false },
      {
        text: "Posts",
        icon: "mdi-account-multiple",
        name: "admin/posts",
        admin: true,
      },
      {
        text: "Users",
        icon: "mdi-account-multiple",
        name: "admin/users",
        admin: true,
      },
      {
        text: "Comments",
        icon: "mdi-widgets",
        name: "admin/comments",
        admin: true,
      },
      { text: "Register", icon: "mdi-widgets", name: "register", admin: false },
      { text: "Login", icon: "mdi-widgets", name: "login", admin: false },

    ],
  }),
  watch: {
    group() {
      this.drawer = false;
          const token = useCookie("token");
    this._token = token;
    },
  },
  async mounted() {},
  async created() {
    const token = useCookie("token");
    this._token = token;
  },
  methods: {
    visitPage(page) {
      const router = useRouter();
      router.push({ path: page });
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
