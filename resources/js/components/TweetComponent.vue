<template>
  <div class="rounded-lg bg-light border mb-1">
    <div class="d-flex justify-content-between p-1">
      <small>{{ tweetData.created_at | formatDate }}</small>
      <button v-if="canHide" class="btn" v-bind:class="[ hided ? 'btn-primary' : 'btn-warning']" v-on:click="onClickHide()">{{ hided ? 'Show' : 'Hide' }}</button>
    </div>

    <div class="p-2">
      <p>{{ tweetData.text }}</p>
    </div>
  </div>
</template>

<script>

export default {
  props: [
    "tweetData",
    "canHide",
    "users_id",
    "hided_id",
    "hided"
  ],
  data() {
    return {}
  },
  mounted() {
  },
  methods: {
    onClickHide() {
      if (this.hided) {
        axios.delete('/api/hidedtweet/' + this.hided_id)
          .subscribe(response => {
            if (response.data.statusCode == 200) {
              this.$emit('update');
            }
          });
      } else {
        const params = {
          users_id: this.users_id,
          tweet_id: this.tweetData.id
        };
        axios.post('/api/hidedtweet', params)
          .subscribe(response => {
            if (response.data.statusCode == 200) {
              this.hided = true;
              this.hided_id = response.data.id;
              this.$emit('update');
            }
          });
      }
    }
  }
};
</script>