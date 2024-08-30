<template>
  <v-row>
    <Head>
      <Title>{{ 'Welcome - Level 7 Assessment' }}</Title>
      <Meta name="description" :content="'Level 7 Assessment Description'" />
    </Head>

    <v-col cols="12" md="12">
      <h1 class="text-uppercase" >Welcome - Level 7 Blog Assessment (By Mandiso Ngwenya)</h1>
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
            height="100%"
            eager
            position="center center"
            :src="'http://127.0.0.1:8000/no-image.jpg'"
            :href="post.title"
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
    <!-- </template> -->
  </v-row>
</template>

<script>
definePageMeta({
  layout: "web-layout",
  // middleware: "auth",
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
    async handleCookies() {
      let test = await $fetch("api/token", {
        method: "POST",
        body: {
          cookie: "Test=Cookie update",
        },
      });

      const token = useCookie("token");
      console.log(token.value);
    },
  },
};
</script>



<style>
</style>
