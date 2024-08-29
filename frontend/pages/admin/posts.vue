<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Posts</h1>
    </v-col>
    <v-row>
      <v-row>
        <v-col cols="12" md="12">
          <v-card class="p-5">
            <v-col cols="12" md="12">
              <div class="mb-5">
                <v-btn
                  role="button"
                  width="100%"
                  @click.prevent="createArticle()"
                  >Create Post
                </v-btn>
              </div>
            </v-col>
            <v-col cols="12" md="12">
              <DataTable
                :data="data"
                :datatable="datatable"
                @retrieveData="retrieveData"
              >
              </DataTable>
            </v-col>
          </v-card>
        </v-col>
      </v-row>
    </v-row>
  </v-row>
</template>


<script>
definePageMeta({
  layout: "web-layout",
});
export default {
  components: {},
  data: () => ({
    data: [],
    payload: {},

    datatable: {
      parentRoute: "posts",
      links: [
        {
          link: "/admin/comments",
          type: "GET",
          method: false,
          api: false,
          params: true,
          paramKey: "id",
          name: "Comments",
          icon: "mdi-comment",
        },
        {
          link: "/admin/create-post",
          type: "GET",
          method: false,
          api: false,
          params: true,
          paramKey: "id",
          name: "Edit",
          icon: "mdi-pencil",
        },

        {
          link: "/admin/view-post",
          type: "GET",
          method: false,
          api: false,
          params: true,
          paramKey: "id",
          name: "View",
          icon: "mdi-eye",
        },
        {
          link: "/api/post/delete",
          type: "POST",
          method: true,
          api: true,
          params: false,
          paramKey: false,
          name: "Delete",
          icon: "mdi-delete",
        },
      ],
      parent: "",
      searchData: {
        column: "title",
        model: "post",
      },
      title: "Posts",
      headers: [
        {
          title: "Title",
          align: "start",
          sortable: true,
          key: "title",
        },
        {
          title: "Created",
          align: "start",
          sortable: true,
          key: "created_at",
        },
        {
          title: "Published",
          align: "start",
          sortable: true,
          key: "published",
        },
        {
          title: "Actions",
          key: "actions",
          sortable: false,
        },
      ],
      items: [{}],
      itemsPerPage: 12,
    },
  }),
  watch: {},
  async mounted() {},
  async created() {
    this.data = await $fetch("http://127.0.0.1:8000/api/posts", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (this.data.success) {
      this.data = this.data.data;
    }
  },
  methods: {
    retrieveData(response) {
      if (response.success) {
        this.data = response.data;
      }
    },
    createArticle() {
      const router = useRouter();
      router.push({ path: "/admin/create-post" });
    },

    searchTable(loadMore = false) {
      this.payload.searchTerm = this.keyword;
      this.payload.action = "search-post";
      if (this.payload.searchTerm !== "") {
        let url = "/search";
        if (loadMore) {
          url = url + "?page=" + (this.authorsData.current_page + 1);
        }
      } else {
      }
    },
    savePost() {
      this.payload.searchTerm = this.form.author;
      this.payload.action = "search-authors";
      this.payload.form;
      axios
        .post("action", this.payload)
        .then((res) => {
          this.resultsView = true;
          this.authorsData = res.data;
        })
        .catch((err) => {});
    },
    async getA() {
      this.response = await $fetch("http://127.0.0.1:8000/api/posts", {
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
    },
  },
};
</script>



<style>
</style>
