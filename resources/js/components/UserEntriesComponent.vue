<template>
  <div class="card">
    <div class="card-header">
      <h2>Entries for {{ user.name }}</h2>
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
      entries: [],
      user: {}
    }
  },
  mounted() {
    axios.get('/api/users/' + this.users_id)
      .subscribe(response => {
        if (response.data.statusCode == 200) {
          this.user = response.data.data;
          axios.get('/api/entries/list/' + this.users_id)
            .subscribe(response => {
              if (response.data.statusCode == 200) {
                this.entries = response.data.data;
              }
            });
        }
      });
  }
};
</script>