<template>
  <div class="card">
    <div class="card-header">
      <h2>Tweets</h2>
    </div>
    <div class="card-body">
      <div class="d-flex justify-content-end">
        <div>
          <tweet-component
            v-for="tweet in visibleTweets"
            :key="tweet.id"
            :tweetData="tweet"
            :can-hide="canHide"
            :users_id="users_id"
            :hided_id="getHidedTweetId(tweet.id)"
            :hided="getHidedTweetId(tweet.id) != null"
            @update="updateHidedTweets()"
          >
          </tweet-component>
          <button
            class="btn btn-info float-right"
            v-if="tweets.length != visibleTweets.length"
            v-on:click="onShowMore()"
            >
            Show More
          </button>
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
      visibleTweets: [],
      hidedTweets: [],
      visibleCount: 5
    }
  },
  mounted() {
    axios.get('/api/twitter/' + this.users_id)
      .subscribe(response => {
        if (response.data.statusCode == 200) {
          this.tweets = response.data.data;
          this.getVisibleTweets();
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
    },
    getVisibleTweets() {
      let count = 0;
      this.visibleTweets = [];
      for (let tweet of this.tweets) {
        if (this.canHide || (this.getHidedTweetId(tweet.id) != null)) {
          this.visibleTweets.push(tweet);
          count++;
        }
        if (count == this.visibleCount) {
          break;
        }
      }
    },
    onShowMore() {
      this.visibleCount += 5;
      this.getVisibleTweets();
    }
  }
};
</script>