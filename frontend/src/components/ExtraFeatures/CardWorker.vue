<template>
  <div class="maincontentcards" @click="CheckProfile">
    <img src="../../assets/images/ExtraFeatures/team.png">
    <p>{{ userteam.name }}</p>

    <p>{{ userteam.email }}</p>

    <p>{{ companydata.name }}</p>
    <img  src="../../assets/images/ExtraFeatures/message.png">
  </div>
</template>
<script>
import {mapMutations} from "vuex";

export default {
  name: 'ComumCard',
  props: {
    userteam: {type:Object},
    companydata: {type:Object}
  },
  methods: {
    CheckProfile(){
      this.UpdateUser(this.userteam.id)
      this.$router.push('/UserProfile')
    },
    ...mapMutations(['UpdateUser'])
  }

}
</script>
<style>
.maincontentcards p {
  margin: 10px 15px;
  width: 16.3vw;
  margin-left: 20px;
}

.maincontentcards {
  width: 60vw;
  height: 40px;
  border-bottom: 1px solid lightgray;
  display: flex;
  align-items: center;

  cursor: pointer;
}
.maincontentcards img {
  width: 30px;
  margin-left: 10px;
}
</style>