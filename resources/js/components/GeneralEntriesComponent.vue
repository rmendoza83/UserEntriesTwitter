<template>
  <div class="card">
    <div class="card-header">
      <h2>General Entries</h2>
    </div>
    <div class="card-body">
      <div class="container">
        <div
          class="row mb-2"
          v-for="entry in entries"
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
      entries: []
    }
  },
  mounted() {
    axios.get('/api/entries/')
      .subscribe(response => {
        if (response.data.statusCode == 200) {
          this.entries = response.data.data;
        }
      });
  },
  methods: {
    viewProfile(users_id) {
      console.log(this);
      this.$router.push({
        path: '/view-profile/' + users_id
      });
    }
  }
};
</script>