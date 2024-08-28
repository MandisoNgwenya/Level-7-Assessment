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
                  <!-- <NuxtLink to="/admin/create-post">
    About page
  </NuxtLink> -->
                </v-btn>
              </div>
            </v-col>
            <v-col cols="12" md="12">
              <div class="card-body">
                <h4 class="header-title mt-0 mb-3 text-right">
                  {{ datatable.title }}
                </h4>
                <div class="col-md-12 mb-3">
                  <v-text-field
                    :label="'Search'"
                    v-model="keyword"
                    v-on:keyup="searchTable()"
                  ></v-text-field>
                </div>
                <div
                  data-v-8d6f2985=""
                  class="v-table v-table--has-top v-table--has-bottom v-theme--light v-table--density-default v-data-table elevation-1"
                >
                  <div v-if="data.items" class="v-table__wrapper">
                    <table>
                      <thead>
                        <tr>
                          <th
                            class="v-data-table__td v-data-table-column--align-start v-data-table__th v-data-table__th--sortable"
                            v-if="datatable.headers"
                            v-for="(header, index) in datatable.headers"
                          >
                            <div class="v-data-table-header__content">
                              <span>{{ header.title }}</span>
                              <i
                                class="mdi-arrow-up mdi v-icon notranslate v-theme--light v-icon--size-default v-data-table-header__sort-icon"
                                aria-hidden="true"
                              ></i>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in data.items"
                          class="v-data-table__tr"
                        >
                          <!--                            {{item}}-->

                          <td
                            v-if="datatable.headers"
                            v-for="(header, indexH) in datatable.headers"
                            class="v-data-table__td v-data-table-column--align-start"
                          >
                            <div v-if="header.key !== 'actions'">
                              {{ item[header.key] }}
                            </div>
                            <div v-else>
                              <Link
                                v-if="this.datatable.viewLink !== 'order'"
                                :href="this.datatable.action + '?id=' + item.id"
                                class="dropdown-item"
                                type="button"
                                ><i class="fa fa-eye"></i> Edit
                              </Link>

                              <Link
                                v-if="this.datatable.viewLink === 'order'"
                                :href="this.datatable.action + '?id=' + item.id"
                                class="dropdown-item"
                                type="button"
                                ><i class="fa fa-eye"></i> View Order
                              </Link>
                              <Link
                                v-if="this.datatable.action === '_view_domain'"
                                :href="
                                  this.datatable.action +
                                  '?id=' +
                                  item.id +
                                  '&action=view-articles'
                                "
                                class="dropdown-item"
                                type="button"
                                ><i class="fa fa-eye"></i> View Articles
                              </Link>
                            </div>

                            <!--                                {{header}}-->
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div v-else class="p-5">No results found</div>
                </div>

                <v-card v-if="data.items" class="mt-4">
                  <div class="p-2">
                    <div class="row">
                      <div class="col-md-12">
                        <ul class="pagination">
                          <Link
                            v-if="data.previous_page !== null"
                            @click.prevent="
                              getData(
                                data.previous_page +
                                  '&itemsPerPage=' +
                                  this.datatable.itemsPerPage
                              )
                            "
                            :href="
                              data.previous_page +
                              '&itemsPerPage=' +
                              this.datatable.itemsPerPage
                            "
                          >
                            <v-btn class="pagination-navigation"
                              ><i class="fa fa-chevron-left"></i
                            ></v-btn>
                          </Link>

                          <span
                            v-if="data.links"
                            v-for="(links, index) in data.links"
                          >
                            <Link
                              v-if="links !== '...' && !action"
                              v-for="(link, i) in links"
                              :href="
                                link +
                                '&itemsPerPage=' +
                                this.datatable.itemsPerPage
                              "
                              @click.prevent="
                                getData(
                                  link +
                                    '&itemsPerPage=' +
                                    this.datatable.itemsPerPage
                                )
                              "
                            >
                              <v-btn
                                type="button"
                                class="pagination-item"
                                :class="{ active: data.current_page === i }"
                              >
                                {{ i }}</v-btn
                              ></Link
                            >
                            <Link
                              v-if="links !== '...' && action"
                              v-for="(link, i) in links"
                              :href="
                                link +
                                '&itemsPerPage=' +
                                this.datatable.itemsPerPage +
                                '&action=' +
                                this.action +
                                '&id=' +
                                this.id
                              "
                              @click.prevent="
                                getData(
                                  link +
                                    '&itemsPerPage=' +
                                    this.datatable.itemsPerPage
                                )
                              "
                            >
                              <v-btn
                                type="button"
                                class="pagination-item"
                                :class="{ active: data.current_page === i }"
                              >
                                {{ i }}</v-btn
                              ></Link
                            >

                            <Link v-if="links === '...'">
                              <a
                                type="button"
                                class="pagination-item"
                                :class="{ active: data.current_page === i }"
                              >
                                {{ "..." }}</a
                              ></Link
                            >
                          </span>

                          <Link
                            v-if="data.next_page !== null"
                            @click.prevent="
                              getData(
                                data.next_page +
                                  '&itemsPerPage=' +
                                  this.datatable.itemsPerPage
                              )
                            "
                            :href="
                              data.next_page +
                              '&itemsPerPage=' +
                              this.datatable.itemsPerPage
                            "
                          >
                            <v-btn type="button" class="pagination-navigation"
                              ><i class="fa fa-chevron-right"></i>
                            </v-btn>
                          </Link>
                        </ul>
                      </div>
                    </div>
                  </div>
                </v-card>
              </div>
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
    payload:{},
    datatable: {
      searchData: {
        column: "title",
        model: "post",
      },
      title: "Posts",
      createText: "Create New posts",
      modalComponent: "edit-post",
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
      editLink: "/post",
      createLink: "",
      createAction: "_create_post",
      action: "_view_post",
      mainAction: "post-action",
      modal: true,
      view: false,
      viewLink: "post",
      viewApplications: false,
      formData: {
        action: "edit",
        edit: true,
      },
      content: {
        id: "create_posts",
        create: {
          title: "post",
        },
        edit: {
          title: "Edit post",
        },
        action: "create",
      },
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
    console.log(this.data.data);
  },
  methods: {
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
