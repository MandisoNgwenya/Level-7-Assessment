<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Comments</h1>
    </v-col>
    <v-row>
      <v-row>
        <v-col cols="12" md="12">
          <v-card class="p-5">
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
      parentRoute: "comments",
      links: [
        {
          link: "",
          type: "GET",
          method: false,
          api: false,
          params: true,
          paramKey: "id",
          name: "View Post",
          icon: "mdi-eye",
        },

        {
          link: "/api/comment/delete",
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
      title: "Comments",
      headers: [
        {
          title: "Comment",
          align: "start",
          sortable: true,
          key: "comment",
        },
        {
          title: "User",
          align: "start",
          sortable: true,
          key: "user_id",
        },
        {
          title: "Post",
          align: "start",
          sortable: true,
          key: "post_id",
        },
        {
          title: "Actions",
          key: "actions",
          sortable: false,
        },
      ],
      items: [{}],
      itemsPerPage: 5,
    },
  }),
  watch: {},
  async mounted() {},
  async created() {
    this.data = await $fetch("http://127.0.0.1:8000/api/comments", {
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
  },
};
</script>



<style>
</style>
