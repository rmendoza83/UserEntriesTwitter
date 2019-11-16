<template>
  <div class="card">
    <div class="card-header">
      <h2>Tweets</h2>
    </div>
    <div class="card-body">
      <div class="d-flex justify-content-end">
        <div>
          <tweet-component
            v-for="tweet in tweets"
            :key="tweet.id"
            :tweetData="tweet"
            :can-hide="canHide"
            :users_id="users_id"
            :hided_id="getHidedTweetId(tweet.id)"
            :hided="getHidedTweetId(tweet.id) != null"
            @update="updateHidedTweets()"
          >
          </tweet-component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "canHide",
    "users_id"
  ],
  data() {
    return {
      tweets: [],
      hidedTweets: []
    }
  },
  mounted() {
    axios.get('/api/twitter/' + this.users_id)
      .subscribe(response => {
        if (response.data.statusCode == 200) {
          this.tweets = response.data.data;
          axios.get('/api/hidedtweet')
            .subscribe(response => {
              if (response.data.statusCode == 200) {
                this.hidedTweets = response.data.data;
              }
            });
        }
      });
  },
  methods: {
    getHidedTweetId(tweet_id) {
      const hidedTweet = this.hidedTweets.find(item => {
        return (item.tweet_id === tweet_id);
      });
      if (hidedTweet == undefined) {
        return null;
      }
      return hidedTweet.id;
    },
    updateHidedTweets() {
      axios.get('/api/hidedtweet')
        .subscribe(response => {
          if (response.data.statusCode == 200) {
            this.hidedTweets = response.data.data;
          }
        });
    }
  }
};
</script>