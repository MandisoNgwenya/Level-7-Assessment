<template>
  <div class="card-body">

    <div class="col-md-12 mb-3">
      <v-text-field
        :label="'Search'"
        v-model="keyword"
        v-on:keyup="searchTable(datatable.parentRoute)"
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
            <tr v-for="(item, index) in data.items" class="v-data-table__tr">
              <td
                v-if="datatable.headers"
                v-for="(header, indexH) in datatable.headers"
                class="v-data-table__td v-data-table-column--align-start"
              >
                <div v-if="header.key !== 'actions'">
                  {{ item[header.key] }}
                </div>
                <div v-else>
                  <span v-for="(link, index) in datatable.links">
                    <NuxtLink
                      class="pl-2"
                      type="button"
                      v-if="link.method === false && link.params === true"
                      :href="link.link + '?' + link.paramKey + '=' + item.id"
                    >
                      {{ link.name }}
                    </NuxtLink>
                    <NuxtLink
                      class="pl-2"
                      type="button"
                      v-else
                      href="javascript:void(0)"
                      @click.prevent="
                        gotToMethod(link.link, link.type, link, item)
                      "
                    >
                      {{ link.name }}
                    </NuxtLink>

                    <v-btn
                      v-if="link.method === false && link.params === true"
                      @click.prevent="
                        gotToMethod(
                          link.link + '?' + link.paramKey + '=' + item.id,
                          link.type,
                          link,
                          item
                        )
                      "
                      :icon="link.icon"
                      variant="text"
                    ></v-btn>
                    <v-btn
                      v-else
                      :icon="link.icon"
                      variant="text"
                      @click="gotToMethod(link.link, link.type, link, item)"
                    ></v-btn>
                  </span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else class="p-5">No results found</div>
    </div>

    <v-card v-if="data.items" class="mt-4">
      <div class="p-2">
        <v-row>
          <v-col cols="12" md="6">
            <ul class="pagination">
              <NuxtLink
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
                <v-btn icon="mdi-arrow-left"></v-btn>
              </NuxtLink>

              <span v-if="data.links" v-for="(links, index) in data.links">
                <NuxtLink
                  v-if="links !== '...' && !action"
                  v-for="(link, i) in links"
                  :href="link + '&itemsPerPage=' + this.datatable.itemsPerPage"
                  @click.prevent="
                    getData(
                      link + '&itemsPerPage=' + this.datatable.itemsPerPage
                    )
                  "
                >
                  <v-btn
                    type="button"
                    class="pagination-item"
                    :class="{ active: data.current_page === i }"
                  >
                    {{ i }}</v-btn
                  ></NuxtLink
                >
                <NuxtLink
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
                      link + '&itemsPerPage=' + this.datatable.itemsPerPage
                    )
                  "
                >
                  <v-btn
                    type="button"
                    class="pagination-item"
                    :class="{ active: data.current_page === i }"
                  >
                    {{ i }}</v-btn
                  ></NuxtLink
                >

                <NuxtLink v-if="links === '...'">
                  <a
                    type="button"
                    class="pagination-item"
                    :class="{ active: data.current_page === i }"
                  >
                    {{ "..." }}</a
                  ></NuxtLink
                >
              </span>

              <NuxtLink
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
                <v-btn icon="mdi-arrow-right"></v-btn>
              </NuxtLink>
            </ul>
          </v-col>
        </v-row>
      </div>
    </v-card>
  </div>
</template>


<script>
export default {
  props: ["data", "datatable"],
  setup() {},
  data: function () {
    return {};
  },
  components: {},
  computed: {},
  watch: {},
  headers: {},
  mounted() {},
  methods: {
    gotToMethod(url, type, link, item) {
      console.log(url);
      if (type === "GET" && link.api === false) {
        // internal route
        const router = useRouter();
        router.push({ path: url, params: { id: item.id } });
      }
      //   console.log(url, type, link, item);
    },
    async searchTable(parentRoute) {
      let url = "http://127.0.0.1:8000/api/" + parentRoute;
      if (this.keyword !== " ") {
         url =
          "http://127.0.0.1:8000/api/" +
          parentRoute +
          "?keyword=" +
          this.keyword;
      }
      let updatedData = await $fetch(url, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      });
      this.$emit("retrieveData", updatedData);
    },
    async getData(item) {
      console.log(item);
      let updatedData = await $fetch(item, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      });
      this.$emit("retrieveData", updatedData);
    },
  },
};
</script>

<style lang="scss" scoped>
.v-data-table-footer {
  display: none !important;
}

.v-card {
  border-radius: 0;
}

a:hover {
  cursor: pointer;
}

.v-data-table-footer {
  display: none;
}

$theme: (
  "background": white,
  "foreground": #00040d,
  "primary": #00040d,
);
$size: (
  "font": 15px,
  "item": 2.2rem,
);

.pagination-item,
.pagination-navigation,
.pagination-more {
  height: map-get($size, "item");
  width: map-get($size, "item");
  margin: 0.3rem;
  font-size: map-get($size, "font");
  color: map-get($theme, "foreground");
  font-weight: 700;
}

.pagination-item,
.pagination-navigation {
  background-color: map-get($theme, "background");
  border-radius: 4px;
  transition-property: opacity, color, background-color;
  transition-duration: 160ms;
  transition-timing-function: cubic-bezier(0.39, 0.575, 0.565, 1);
}

.pagination-item {
  padding: 0 5px;

  &.active {
    color: map-get($theme, "background");
    background-color: map-get($theme, "primary");
  }

  &:hover,
  &:focus {
    background-color: darken(map-get($theme, "background"), 3%);

    &.active {
      background-color: lighten(map-get($theme, "primary"), 4%);
    }
  }

  &:active {
    background-color: darken(map-get($theme, "background"), 7%);

    &.active {
      background-color: lighten(map-get($theme, "primary"), 9%);
    }
  }
}

.pagination-navigation {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  margin-left: 10px;
  margin-right: 10px;
  text-decoration: none;

  &.disabled {
    opacity: 0.6;
    cursor: default;
  }

  &:hover:not(.disabled),
  &:focus:not(.disabled) {
    background-color: darken(map-get($theme, "background"), 3%);
  }

  &:active:not(.disabled) {
    background-color: darken(map-get($theme, "background"), 7%);
  }
}

.pagination-more {
  display: inline-flex;
  align-items: flex-end;
  justify-content: center;
}

.pagination {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  max-width: 100%;
  width: 100%;
  margin: 0;
  padding-left: 0;
  list-style-type: none;

  > li {
    align-items: center;
    display: flex;
  }

  button {
    border: 0;
    outline: none;
    cursor: pointer;
  }

  &.disabled {
    pointer-events: none;
    opacity: 0.6;
  }
}

// LAYOUT

.container {
  margin: 0 auto;
  padding: 0 1rem;
  padding-bottom: 50px;
}

.controls {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 40px 0;

  input {
    width: 60px;
    margin-left: 0.3rem;
    margin-right: 1.5rem;
  }
}

.stage-container {
  padding: 10px 0;
  background-color: white;
  border-radius: 6px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
    0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
</style>