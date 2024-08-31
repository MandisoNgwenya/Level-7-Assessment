<template>
  <v-row>
    <Head>
      <Title>{{ "Welcome - Level 7 Assessment" }}</Title>
      <Meta name="description" :content="'Level 7 Assessment Description'" />
    </Head>

    <v-col cols="12" md="12">
      <h1 class="text-uppercase">
        Welcome - Level 7 Blog Assessment (By Mandiso Ngwenya)
      </h1>
    </v-col>

    <v-col
      v-if="posts.success && posts.data.items.length"
      cols="12"
      md="4"
      v-for="(post, index) in posts.data.items"
      :key="index"
    >
      <v-card class="mx-auto">
        <div class="hover-wrapper">
             <v-img
        v-if="post.thumbnail"
          height="500px"
          width="100%"
          eager
          position="center center"
           :src="'http://127.0.0.1:8000/720526039c7ddee22606ee5a8cb2a1b2/'+post.thumbnail.filename+'.'+post.thumbnail.ext"
          :href="post.url"
        >
        </v-img>
             <v-img
             v-else
          height="500px"
          width="100%"
          eager
          position="center center"
          :src="'http://127.0.0.1:8000/no-image.jpg'"
          :href="post.url"
        >
        </v-img>
        </div>
        <v-card-title>{{ post.title }}</v-card-title>
        <v-card-text class="mt-2">
          <div v-html="post.excerpt"></div>
          <NuxtLink
            :href="'/' + post.title + '?post_id=' + post.id"
            class="float-end"
            >Read More</NuxtLink
          >
        </v-card-text>

        <v-card-actions class="justify-space-between">
          <div class="overline">{{ post.publish_date }}</div>
        </v-card-actions>
        <v-divider class="mt-3"></v-divider>
        <v-card-text>
          <div class="d-flex align-center">
            <v-col sm="12">
              <p v-if="post.user !== null" class="mb-0 subtitle-1">
                by {{ post.user.name }}
              </p>
            </v-col>
          </div>
        </v-card-text>
      </v-card>
    </v-col>

    <v-col cols="12" md="12">
      <div>
        <!-- {{ posts.data.current_page }} -->
        <v-btn
          v-if="posts.success && posts.data.items.length"
          class="m-2"
          @click="loadMorePosts(posts.data.current_page)"
          width="100%"
        >
          Load More
        </v-btn>
      </div>
    </v-col>

    <!-- </template> -->
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
    posts: "",
  }),
  watch: {},
  mounted() {},
  async created() {
    const token = useCookie("token");
    if (token) {
      this.posts = await $fetch("http://127.0.0.1:8000/api/posts", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + token.value,
          Accept: "application/json",
        },
      });
    }
  },

  methods: {
    async loadMorePosts(type) {
      const token = useCookie("token");

      if (token) {
        if (this.posts.data.current_page >= 1) {
          let page = 1;
          let itemsPerPage = this.posts.data.itemsPerPage + 1;
          let url =
            "http://127.0.0.1:8000/api/posts?page=" +
            page +
            "&itemsPerPage=" +
            itemsPerPage;
          this.posts = await $fetch(url, {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + token.value,
              Accept: "application/json",
            },
          });
        }
      }
    },
  },
};
</script>



<style>
</style>
