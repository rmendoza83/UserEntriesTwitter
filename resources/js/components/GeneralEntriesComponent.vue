<template>
  <div class="card">
    <div class="card-header">
      <h2>General Entries</h2>
    </div>
    <div class="card-body">
      <div class="container">
        <div
          class="row mb-2"
          v-for="entry in visibleEntries"
          :key="entry.id"
          >
          <div class="col-md-12">
            <div class="rounded-lg bg-light border mb-1 p-2">
              <div class="d-flex justify-content-between">
                <h3>{{ entry.title }}</h3>
                <small>{{ entry.created_at | formatDate }}</small>
              </div>
              <div class="p-2 text-justify">
                <p>{{ entry.content }}</p>
              </div>
              <div class="pt-3 d-flex justify-content-end">
                <small><b>Author: </b><a v-bind:href="'/profile/' + entry.users_id">{{ entry.name }}</a></small>
              </div>
            </div>
          </div>
        </div>
        <button
          class="btn btn-info float-right"
          v-if="entries.length > visibleEntries.length"
          v-on:click="onShowMore()"
          >
          Show More
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "users_id",
    "logged"
  ],
  data() {
    return {
      entries: [],
      visibleEntries: [],
      visibleCount: 5,
    }
  },
  mounted() {
    axios.get('/api/entries/')
      .subscribe(response => {
        if (response.data.statusCode == 200) {
          this.entries = response.data.data;
          this.getVisibleEntries();
        }
      });
  },
  methods: {
    getVisibleEntries() {
      let count = 0;
      this.visibleEntries = [];
      for (let entry of this.entries) {
        this.visibleEntries.push(entry);
        count++;
        if (count == this.visibleCount) {
          break;
        }
      }
    },
    onShowMore() {
      this.visibleCount += 5;
      this.getVisibleEntries();
    }
  }
};
</script>