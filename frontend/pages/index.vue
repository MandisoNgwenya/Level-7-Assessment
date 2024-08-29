<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Welcome</h1>
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
  middleware: "auth",
});

export default {
  components: {},
  data: () => ({
    posts: "",
    title: "test ",
  }),
  watch: {},
  mounted() {},
  async created() {
    this.token = "";
    // const dataStorage = useStorage('data')
    // await dataSto  rage.setItem('_token', '2|P6UxxgpmIskswKErVfMaDF9jkR0HjqZ4V66OmSkv2ce16c47')

    // localStorage.setItem("_token", "'2|P6UxxgpmIskswKErVfMaDF9jkR0HjqZ4V66OmSkv2ce16c47");
    // Read counter cookie
    // let counter = getCookie(event, 'counter');
    // setCookie(event, 'counter', ++counter)

    this.posts = await $fetch("http://127.0.0.1:8000/api/posts", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + this.token,
        Accept: "application/json",
      },
    });
  },
  methods: {},
};
</script>



<style>
</style>
