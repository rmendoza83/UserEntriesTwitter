<template>
  <div class="card">
    <div class="card-header">
      <h2>General Entries</h2>
    </div>
    <div class="card-body">
      <div
        class="d-flex"
        v-for="entry in entries"
        :key="entry.id"
        >
        <div class="rounded-lg bg-light border mb-1">
          <div class="d-flex justify-content-between p-1">
            <h3>{{ entry.title }}</h3>
            <small>{{ entry.creation_date | formatDate }}</small>
          </div>
          <div class="p-2 text-justify">
            <p>{{ entry.content }}</p>
          </div>
          <div class="p-3 d-flex justify-content-end">
            <small><b>Author: </b><a v-bind:href="'/view-profile/' + entry.users_id">{{ entry.name }}</a></small>
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