<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1 class="text-uppercase">Comments</h1>

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
  middleware: "auth",
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
    const token = useCookie("token");

    let url = "http://127.0.0.1:8000/api/comments";   
     const route = useRoute();
    this.post_id = route.query.post_id;
  
    if(this.post_id){
      url = url+'?post_id='+this.post_id;
    }
    if (token) {
      this.data = await $fetch(url, {
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
  },
};
</script>



<style>
</style>
