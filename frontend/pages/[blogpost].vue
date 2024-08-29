<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Level 7 Assessment</h1>
    </v-col>
    <v-col cols="12" md="6">
      <v-img
        height="500px"
        width="100%"
        eager
        position="center center"
        :src="'http://127.0.0.1:8000/no-image.jpg'"
        :href="post.url"
      >
      </v-img>
    </v-col>
    <v-col cols="12" md="6">
      <v-row>
        <v-col cols="12" md="12">
          <v-card-title>{{ post.title }}</v-card-title>
        </v-col>

        <v-col cols="12" md="12">
          <v-card-text> <div v-html="post.excerpt"></div> </v-card-text>
        </v-col>
      </v-row>

      <v-divider class="mt-3"></v-divider>
      <v-col cols="12" md="12">
        <v-card-text> <div v-html="post.body"></div> </v-card-text>
      </v-col>
      <v-divider class="mt-3"></v-divider>

  
    </v-col>
    <v-col cols="12" md="12">
        <v-textarea :label="'Comment'" v-model="form.comment"></v-textarea>
        <div class="float-end">
          <v-btn class="m-2" @click="sendComment"> Send Comment </v-btn>
          <!-- <v-btn icon="mdi-comment" variant="text"></v-btn> -->
        </div>
      </v-col>

      <div class="mt-8"></div>
      <v-col
        v-if="comments"
        v-for="(comment, index) in comments.items"
        cols="12"
        md="12"
      >
        <v-card>
          <v-card-text>
            <v-textarea v-model="comment.comment" readonly></v-textarea>

            <v-divider class="mt-5"></v-divider>
            <div class="mt-2">
              <v-btn icon="mdi-send" variant="text" class="float-end"></v-btn>
              <v-btn
                icon="mdi-comment"
                variant="text"
                class="float-end"
              ></v-btn>
              <v-btn icon="mdi-delete" variant="text" class="float-end"></v-btn>
            </div>
          </v-card-text>

          <v-divider class="mt-8"></v-divider>
        </v-card>
      </v-col>

      <v-col cols="12" md="12">
        <div>
          <v-btn
            v-if="comments.more_items"
            class="m-2"
            @click="loadMoreComments(comments.current_page)"
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
});
export default {
  components: {},
  data: () => ({
    post: "",
    comments: "",
    form: {
      comment: "",
      post_id: 0,
      user_id: 0,
    },
  }),
  watch: {},
  async mounted() {},
  async created() {
    // get by rouse id must change
    this.post = await $fetch("http://127.0.0.1:8000/api/posts/1", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (this.post.success) {
      if (this.post.data) {
        this.post = this.post.data;
      }
    }
    this.comments = await $fetch(
      "http://127.0.0.1:8000/api/comments?post_id=1",
      {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
    if (this.comments.success) {
      if (this.comments.data) {
        this.comments = this.comments.data;
      }
    }
  },
  methods: {
    async loadMoreComments(type) {
      if (this.comments.current_page >= 1) {
        let itemsPerPage = this.comments.itemsPerPage + 2;
        let page = 1;
        if (type === "more") {
          itemsPerPage = this.comments.itemsPerPage + 2;
          page = this.comments.next_page;
        } else {
          itemsPerPage = this.comments.itemsPerPage + 2;
          if (this.comments.previous_page === null) {
            page = this.comments.previous_page;
          }
        }
        let url =
          "http://127.0.0.1:8000/api/comments?page=" +
          page +
          "&itemsPerPage=" +
          itemsPerPage +
          "&post_id=1";

        this.comments = await $fetch(url, {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        });
        if (this.comments.success) {
          if (this.comments.data) {
            this.comments = this.comments.data;
          }
        }

        axios
          .post("/?page=" + page + "&itemsPerPage=" + itemsPerPage)
          .then((res) => {
            if (res.data.success) {
              this.noResults = false;
              this.itemsPerPageLatestValue = res.data.data.itemsPerPage;
              this.$emit("retrieveData", res.data.data);
            } else {
              this.noResults = true;
              this.overlay = false;
            }
          })
          .catch((err) => {});
      }
      console.log(this.data);
    },
    async sendComment() {
      this.form.post_id = this.post.id;
      this.form.user_id = 1;
      this.response = await $fetch("http://127.0.0.1:8000/api/create-comment", {
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
