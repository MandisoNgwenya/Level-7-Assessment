<template>
      <Head>
      <Title>{{ "Posts - Level 7 Assessment" }}</Title>
      <Meta name="description" :content="'Level 7 Assessment Description'" />
    </Head>
  <v-row>
    <v-col cols="12" md="12">
      <h1 class="text-uppercase">Posts</h1>
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
  middleware: "auth",
});
export default {
  components: {},
  data: () => ({
    data: [],
    payload: {},

    datatable: {
      parentRoute: "posts",
      _token: false,
      links: [
        {
          link: "/admin/comments",
          type: "GET",
          method: false,
          api: false,
          params: true,
          paramKey: "post_id",
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
    const token = useCookie("token");
    if (token) {
      this.data = await $fetch("http://127.0.0.1:8000/api/posts", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + token.value,
          Accept: "application/json",
        },
      });
      if (this.data.success) {
        this.data = this.data.data;
      }
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
  },
};
</script>



<style>
</style>
