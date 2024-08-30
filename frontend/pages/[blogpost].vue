<template>
      <Head v-if="post">
      <Title>{{ post.title }}</Title>
      <Meta name="description" :content="post.description" />
      <Meta name="keywords" :content="post.keywords" />
    </Head>
  <v-card class="mt-8">
    <v-row>
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
            <v-card-title>
              <h1>{{ post.title }}</h1></v-card-title
            >
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
    </v-row>
  </v-card>

  <v-card class="mt-8">
    <v-col cols="12" md="12">
    
      <v-card-title>  <v-chip   class="ma-2" label> {{'Tags'}} </v-chip></v-card-title>


    
        <v-chip v-if=" post.tags" v-for="(tag,index) in  post.tags" class="ma-2" color="pink" label>
          <v-icon  icon="mdi-label" start></v-icon>
          {{tag.tag}}
        </v-chip>

   
    </v-col>

    <v-card class="mx-auto">

      <v-list lines="two">
        <v-list-subheader>Comments</v-list-subheader>

        <v-list-item
          v-if="comments"
          v-for="(comment, index) in comments.items"
          prepend-avatar="https://cdn.vuetifyjs.com/images/lists/1.jpg"
        >
          <template v-slot:subtitle>
            <span class="font-weight-bold"></span>   {{comment.user.name}} 
          </template>

          <v-textarea rows="2" v-model="comment.comment" class="mt-2"></v-textarea>
          <v-divider></v-divider>
          <div class="mt-2">
    
         
            <v-btn
              icon="mdi-send"
              variant="text"
              class="float-end"
              @click="sendComment(comment)"
            ></v-btn>
            <v-btn
              icon="mdi-delete"
              variant="text"
              class="float-end"
              @click="deleteComment(comment)"
            ></v-btn>
          </div>
        </v-list-item>

        <v-divider inset></v-divider>
      </v-list>
    </v-card>
  
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

    <v-col cols="12" md="12">
      <v-textarea :label="'Comment'" v-model="form.comment"></v-textarea>
      <div>
        <v-btn width="100%" class="m-5 mb-5" @click="sendComment(false)">
          Send Comment
        </v-btn>
      </div>
    </v-col>
  </v-card>
</template>


<script>
definePageMeta({
  layout: "web-layout",
});
export default {
  components: {},
  data: () => ({
    payload: {},
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
    const route = useRoute();
    this.post_id = route.query.post_id;
    const token = useCookie("token");
    if (token) {
      this.post = await $fetch(
        "http://127.0.0.1:8000/api/posts/" + this.post_id,
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + token.value,
            Accept: "application/json",
          },
        }
      );
      this.comments = await $fetch(
        "http://127.0.0.1:8000/api/comments?post_id=" + this.post_id,
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + token.value,
            Accept: "application/json",
          },
        }
      );
      if (this.post.success) {
        if (this.post.data) {
          this.post = this.post.data;
        }
      }
      if (this.comments.success) {
        if (this.comments.data) {
          this.comments = this.comments.data;
        }
      }
    }
  },
  methods: {
    async loadMoreComments(type) {
      const token = useCookie("token");
      if (token) {
        if (this.comments.current_page >= 1) {
          let itemsPerPage = this.comments.itemsPerPage + 5;
          let page = 1;
          if (type === "more") {
            itemsPerPage = this.comments.itemsPerPage + 5;
            page = this.comments.next_page;
          } else {
            itemsPerPage = this.comments.itemsPerPage + 5;
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
              Authorization: "Bearer " + token.value,
              Accept: "application/json",
            },
          });
          if (this.comments.success) {
            if (this.comments.data) {
              this.comments = this.comments.data;
            }
          }
        }
      }
    },
    async deleteComment(comment) {
      const token = useCookie("token");
      if (token) {
        this.payload.comment = comment;
        this.comments = await $fetch(
          "http://127.0.0.1:8000/api/comment/delete",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + token.value,
              Accept: "application/json",
            },
            body: { form: this.payload },
          }
        );
        if (this.comments.success) {
          if (this.comments.data) {
            this.comments = this.comments.data;
          }
        }
      }
    },
    async sendComment(comment) {
      const token = useCookie("token");
      if (token) {
        this.payload.post_id = this.post.id;
        this.payload.user_id = 1;
        this.payload.id = 0;
        let url = "http://127.0.0.1:8000/api/create-comment";
        if (comment === false) {

          this.payload.comment = this.form.comment;
          
        } else {
          this.payload.comment = comment.comment;
          this.payload.id = comment.comment;
          this.payload.id = comment.id;
          url = "http://127.0.0.1:8000/api/update-comment";
        }
        this.comments = await $fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + token.value,
            Accept: "application/json",
          },
          body: { form: this.payload },
        });

        if (this.comments.success) {
          if (this.comments.data) {
            this.comments = this.comments.data;
            this.form.comment = "";
          }
        }
      }
    },
  },
};
</script>



<style>
</style>
