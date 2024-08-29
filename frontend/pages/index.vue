<template>
  <v-row>
    <!-- <Head>
      <Title>{{ title }}</Title>
      <Meta name="description" :content="title" />
      <Style type="text/css" children="body { background-color: green; }" ></Style>
    </Head> -->

    <v-col cols="12" md="12">
      <h1>Welcome</h1>

      <!-- <v-btn @click="handleCookies()"> Tesadznm t</v-btn> -->
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
  mounted() {
  
  },
  async created() {
    this.posts = await $fetch("http://127.0.0.1:8000/api/posts", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + this.token,
        Accept: "application/json",
      },
    });
  },

  methods: {
    async handleCookies() {
      alert("dsfjh");
      let test = await $fetch("api/token", {
        method: "POST",
        body: {
          cookie: "Test=Cookie update",
        },
      });

       const token = useCookie('token');
    console.log(token.value)
    },
  },
};
</script>



<style>
</style>
