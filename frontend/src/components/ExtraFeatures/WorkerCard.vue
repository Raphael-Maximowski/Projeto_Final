<template>
  <div class="boxwork" @click="GetProfile">
    <div class="contentusers">
      <img v-if=" userteam.is_admin == 1" width="25px" src="../../assets/images/ExtraFeatures/admin-panel.png">
      <img v-if="userteam.is_admin != 1" width="20px" src="../../assets/images/ExtraFeatures/user.png">

    </div>
    <div class="nameuser">{{ userteam.name }}</div>
    <div><img v-if="userteam.is_admin != 1" @click="RemoveFromTeam" width="17px" src="../../assets/images/ExtraFeatures/delete.png"></div>

  </div>
</template>
<style>
.contentusers img {
  width: 20px;
}
.contentusers{
  margin: 0px 10px;
}
.nameuser {
  width: 25vw;
  font-size: 14px;
}
.boxwork {
  height: 40px;
  display: flex;
  align-items: center;
  border: 1px solid lightgray;

  cursor: pointer;
}
</style>
<script>
import {RemoveTeam} from "@/services/HttpService.js";
import {mapMutations} from "vuex";

export default {
  name: "WorkerCards",
  data(){
    return {
      admin : false
    }
  },
  props: {
    userteam: {type:Object}
  },
  created(){
  },
  methods: {
    async RemoveFromTeam(){
      const data = {
        user_id : this.userteam.id,
        team_id : this.userteam.team_id
      }
      const response = await RemoveTeam(data)
      return response;
    },
    GetProfile(){
      this.UpdateUser(this.userteam.id)
      this.$router.push('/UserProfile')
    },
    ...mapMutations(['UpdateUser'])
  }
}
</script>
