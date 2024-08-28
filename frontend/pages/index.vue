<template>
  <v-app>
    <v-layout>
      <v-app-bar color="primary" prominent>
        <v-app-bar-nav-icon
          variant="text"
          @click.stop="drawer = !drawer"
        ></v-app-bar-nav-icon>

        <v-toolbar-title>Posts</v-toolbar-title>

        <v-spacer></v-spacer>

        <template v-if="$vuetify.display.mdAndUp">
          <v-btn icon="mdi-magnify" variant="text"></v-btn>

          <v-btn icon="mdi-filter" variant="text"></v-btn>
        </template>

        <v-btn
          icon="mdi-dots-vertical"
          variant="text"
          @click.stop="drawer1 = !drawer1"
        ></v-btn>
      </v-app-bar>

      <v-navigation-drawer
        v-model="drawer"
        :location="$vuetify.display.mobile ? 'bottom' : undefined"
        temporary
      >
        <v-list :items="items"></v-list>
      </v-navigation-drawer>
      <v-navigation-drawer
        v-model="drawer1"
        :location="$vuetify.display.mobile ? 'bottom' : undefined"
        temporary
      >
        <v-list :items="items"></v-list>
      </v-navigation-drawer>

      <v-main>
        <v-container>
          <v-row class="album p-5 mt-5">
            <v-col cols="12" md="12">
              <h1>Level 7 Assessment</h1>
            </v-col>
            <!-- <template> -->
            <v-col
              v-if="posts"
              cols="12"
              md="3"
              v-for="(post, index) in posts"
              :key="index"
            >
              <v-card class="mx-auto">
                <div class="hover-wrapper">
                  <v-img
                    height="250"
                    eager
                    position="center center"
                    :src="post.thumbnail"
                    :href="post.url"
                  >
                  </v-img>
                </div>
                <v-card-title>{{ post.title }}</v-card-title>
                <v-card-text>{{ post.summary }}</v-card-text>
                <v-card-actions class="justify-space-between">
                  <v-btn-toggle dense>
                    <v-btn text :href="'/'+post.title">Read now</v-btn>
                    <v-btn text @click="share(post.id)">Share</v-btn>
                  </v-btn-toggle>
                  <div class="overline">{{ post.readDuration }} Minutes</div>
                </v-card-actions>
                <v-divider class="mt-3"></v-divider>
                <v-card-text>
                  <div class="d-flex align-center">
                    <v-col sm="3">
                      <v-img
                        height="60"
                        width="60"
                        aspect-ratio
                        class="rounded-circle"
                        :src="post.authorImage"
                      >
                      </v-img>
                    </v-col>
                    <v-col sm="9">
                      <p class="mb-0 subtitle-1">{{ post.authorName }}</p>
                      <p class="mb-0">{{ post.authorSubline }}</p>
                    </v-col>
                  </div>
                </v-card-text>
              </v-card>
            </v-col>
            <!-- </template> -->
          </v-row>
        </v-container>
      </v-main>
    </v-layout>
  </v-app>
</template>


<script>
 definePageMeta({
  layout: 'custom'
 })
export default {
  components: {},
  data: () => ({
    drawer: false,
    drawer1: false,
    group: null,
    items: [
      {
        title: "Foo",
        value: "foo",
      },
      {
        title: "Bar",
        value: "bar",
      },
      {
        title: "Fizz",
        value: "fizz",
      },
      {
        title: "Buzz",
        value: "buzz",
      },
    ],
    posts: [
      {
        id: "p_14",
        thumbnail:
          "https://images.pexels.com/photos/3737094/pexels-photo-3737094.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        title: "Top 10 Websites",
        url: "https://www.google.com/articel/test6",
        readDuration: 43,
        summary:
          "This is a preview text from a super interesting article about a topic. There are many good reasons to read this article. It is a Top 10 Websites placeholder.",
        authorName: "Petra Musterfrau",
        authorImage:
          "https://images.pexels.com/photos/1036623/pexels-photo-1036623.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        authorSubline: "Funny Guy",
      },
      {
        id: "p_15",
        thumbnail:
          "https://images.pexels.com/photos/3737094/pexels-photo-3737094.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        title: "Top 10 Websites",
        url: "https://www.google.com/articel/test6",
        readDuration: 43,
        summary:
          "This is a preview text from a super interesting article about a topic. There are many good reasons to read this article. It is a Top 10 Websites placeholder.",
        authorName: "Petra Musterfrau",
        authorImage:
          "https://images.pexels.com/photos/1036623/pexels-photo-1036623.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        authorSubline: "Funny Guy",
      },
    ],
  }),
  watch: {
    group() {
      this.drawer = false;
    },
  },
  mounted() {},

  methods: {
    share(id) {
      alert("share id: " + id);
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
