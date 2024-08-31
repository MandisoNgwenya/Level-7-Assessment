<template>
  <v-row>
    <v-col cols="12" md="12">
      <h1>Users</h1>
    </v-col>
    <v-row>
      <v-row>
        <v-col cols="12" md="12">
          <v-card class="p-5">
            <v-col cols="12" md="12">
              <div class="mb-5">
                <v-btn role="button" width="100%" @click.prevent="createUser()"
                  >Create Users
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
    _token: false,
    datatable: {
      parentRoute: "users",
      links: [
        {
          link: "/admin/create-user",
          type: "GET",
          method: false,
          api: false,
          params: true,
          paramKey: "id",
          name: "Edit",
          icon: "mdi-pencil",
        },

        {
          link: "/admin/view-user",
          type: "GET",
          method: false,
          api: false,
          params: true,
          paramKey: "id",
          name: "View",
          icon: "mdi-eye",
        },
        {
          link: "/api/user/delete",
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
      title: "Users",
      headers: [
        {
          title: "Name",
          align: "start",
          sortable: true,
          key: "name",
        },
        {
          title: "Email",
          align: "start",
          sortable: true,
          key: "email",
        },

        {
          title: "Created",
          align: "start",
          sortable: true,
          key: "created_at",
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
      this.data = await $fetch("http://127.0.0.1:8000/api/users", {
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
    createUser() {
      const router = useRouter();
      router.push({ path: "/admin/create-user" });
    },
  },
};
</script>



<style>
</style>
